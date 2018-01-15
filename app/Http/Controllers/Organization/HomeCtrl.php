<?php

namespace App\Http\Controllers\Organization;

use App\Alert;
use App\Follow;
use App\Friend;
use App\Group;
use App\Group_member;
use App\Opportunity_member;
use App\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Opportunity;
use App\Organization_type;
use Illuminate\Support\Facades\Redirect;

class HomeCtrl extends Controller
{
    //
	public function viewHome(){
		$org_id = Auth::user()->id;
		$tracks_hours = Tracking::where('org_id',$org_id)->where('approv_status',1)->where('is_deleted','<>',1)->sum('logged_mins');
		$tracks_hours = $tracks_hours/60;

		$city = Auth::user()->city;
		$state = Auth::user()->state;
		$regional_organizations = User::where('user_role','organization')->where('confirm_code',1)->where('is_deleted','<>',1)->where("state","like","%$state%")->
		where("city","like","%$city%")->pluck('id')->toArray();
		$org_tracks = Tracking::where('is_deleted','<>',1)->where('approv_status',1)->whereIn('org_id',$regional_organizations)->
		groupBy('org_id')->selectRaw('sum(logged_mins)/60 as logged_mins')->pluck('logged_mins')->toArray();
		$i = 1;
		foreach ($org_tracks as $ot){
			if(floatval($ot) > $tracks_hours){
				$i++;
			}
		}
		$follow_data = Follow::where('follower_id',$org_id)->where('is_deleted','<>',1)->orderBy('updated_at','desc')->get();
		$follows = array();
		foreach ($follow_data as $f){
			$follows[$f->id]['id'] = $f->followed_id;
			$follows[$f->id]['type'] = $f->type;
			if($f->type == 'organization'){
				$follows[$f->id]['name'] = User::find($f->followed_id)->org_name;
				$follows[$f->id]['logo'] = User::find($f->followed_id)->logo_img;
				$follows[$f->id]['logged_hours'] = Tracking::where('org_id',$f->followed_id)->where('approv_status',1)->where('is_deleted','<>',1)->sum('logged_mins')/60;
			}else{
				$follows[$f->id]['name'] = Group::find($f->followed_id)->name;
				$follows[$f->id]['logo'] = Group::find($f->followed_id)->logo_img;
				$member_ids = Group_member::where('group_id',$f->followed_id)->where('status',Group_member::APPROVED)->where('is_deleted','<>',1)->pluck('user_id')->toArray();
				$follows[$f->id]['logged_hours'] = Tracking::whereIn('volunteer_id',$member_ids)->where('is_deleted','<>',1)->where('approv_status',1)->sum('logged_mins')/60;
			}
			$date = explode(' ',$f->updated_at);
			$follows[$f->id]['followed_date'] = $date[0];
		}
		return view('organization.home',['logged_hours'=>$tracks_hours,'regional_ranking'=>$i,'follows'=>$follows,'page_name'=>'org_home']);
	}

	public function viewEditAccount(){
		return view('organization.accountsetting',['page_name'=>'','org_type_names'=>Organization_type::all()]);
	}

	public function viewProfile($id = null){
		if($id == null){
			$id = Auth::user()->id;
		}
		if(User::find($id)->user_role == 'volunteer'){
			$user = User::find($id);
			$logged_hours = Tracking::where('volunteer_id',$id)->where('is_deleted','<>',1)->where('approv_status',1)->sum('logged_mins');
			$logged_hours = $logged_hours/60;

			$today = date('Y-m-d');
			$my_opportunities = Opportunity_member::where('user_id',$id)->where('is_deleted','<>',1)->pluck('oppor_id')->toArray();
			$opportunities = Opportunity::whereIn('id',$my_opportunities)->where('type',1)->where('is_deleted','<>',1)->
			where('end_date','>',$today)->get();

			$groups = DB::table('groups')->join('group_members','groups.id','=','group_members.group_id')->where('group_members.user_id',$id)->
			where('group_members.is_deleted','<>',1)->where('group_members.status',Group_member::APPROVED)->where('groups.is_deleted','<>',1)->select('groups.*','group_members.role_id')->get();

			$friends = DB::table('users')->join('friends','users.id','=','friends.friend_id')->where('friends.user_id',$id)->
			where('friends.is_deleted','<>',1)->where('friends.status',2)->
			where('users.is_deleted','<>',1)->where('users.confirm_code',1)->select('users.*')->get();

			$profile_info = array();
			$profile_info['is_my_profile'] = 0;
			if($id == Auth::user()->id){
				$profile_info['is_my_profile'] = 1;
			}
			$is_friend = Friend::where('user_id',Auth::user()->id)->where('friend_id',$id)->where('is_deleted','<>',1)->get()->first();
			if($is_friend == null){
				$profile_info['is_friend'] = 0;
			}else{
				$profile_info['is_friend'] = $is_friend->status;
			}
			$profile_info['is_volunteer'] = 1;
			$profile_info['logged_hours'] = $logged_hours;
			return view('organization.profile',['user'=>$user,'profile_info'=>$profile_info,'opportunity'=>$opportunities,
			                                 'group'=>$groups,'friend'=>$friends,'page_name'=>'vol_profile']);
		}else{
			$profile_info = array();
			$profile_info['is_volunteer'] = 0;
			$profile_info['is_my_profile'] = 1;
			if($id != Auth::user()->id){
				$profile_info['is_my_profile'] = 0;
			}
			$is_followed = Follow::where('follower_id',Auth::user()->id)->where('followed_id',$id)->where('is_deleted','<>',1)->get()->first();
			if($is_followed == null){
				$profile_info['is_followed'] = 0;
			}else{
				$profile_info['is_followed'] = 1;
			}
			$is_friend = Friend::where('user_id',Auth::user()->id)->where('friend_id',$id)->where('is_deleted','<>',1)->get()->first();
			if($is_friend == null){
				$profile_info['is_friend'] = 0;
			}else{
				$profile_info['is_friend'] = $is_friend->status;
			}
			$user = User::find($id);
			$tracks_hours = Tracking::where('org_id',$id)->where('approv_status',1)->where('is_deleted','<>',1)->sum('logged_mins');
			$profile_info['tracks_hours'] = $tracks_hours/60;

			$today = date("Y-m-d");
			$active_oppr = Opportunity::where('org_id',Auth::user()->id)->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)->orderBy('created_at','desc')->get();

			$groups = DB::table('groups')->join('group_members','groups.id','=','group_members.group_id')->where('group_members.user_id',$id)->
			where('group_members.is_deleted','<>',1)->where('groups.is_deleted','<>',1)->select('groups.*','group_members.role_id')->get();

			$my_members = DB::table('opportunity_members')->where('opportunity_members.org_id',$id)->where('opportunity_members.is_deleted','<>',1)->
			join('users','opportunity_members.user_id','=','users.id')->select('users.*')->get();
			$members = array();
			foreach ($my_members as $m){
				$members[$m->id] = $m;
			}

			$friends = DB::table('users')->join('friends','users.id','=','friends.friend_id')->where('friends.user_id',Auth::user()->id)->
			where('friends.is_deleted','<>',1)->where('friends.status',2)->
			where('users.is_deleted','<>',1)->where('users.confirm_code',1)->select('users.*')->get();

			return view('organization.profile',['user'=>$user,'profile_info'=>$profile_info,'active_oppr'=>$active_oppr,'group'=>$groups,
			                                 'members'=>$members,'friend'=>$friends,'page_name'=>'org_profile']);
		}
	}

	public function upload_logo(Request $request) {
		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');

			//you also need to keep file extension as well
//			'.'.$file->getClientOriginalExtension()
			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$get_user = User::find(Auth::user()->id);
			$get_user->logo_img = $name;
			$get_user->save();
		}   
		return Redirect::back()->with('Success', 'Logo image uploaded');
	}

	public function upload_back_img(Request $request) {
		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');

			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$get_user = User::find(Auth::user()->id);
			$get_user->back_img = $name;
			$get_user->save();
		}
		return Redirect::back()->with('Success', 'Back image uploaded');
	}

	public function Search(Request $request){
		$keyword = $request->input('keyword');
		$my_id = Auth::user()->id;
		$org_result = User::where('is_deleted','<>',1)->where(function ($query) use ($keyword) {
			$keyword_terms = explode(' ',$keyword);
			foreach ($keyword_terms as $terms){
				$query->orWhere("org_name", "LIKE","%$terms%")
				      ->orWhere("first_name", "LIKE", "%$terms%")
				      ->orWhere("last_name", "LIKE", "%$terms%")
				      ->orWhere("brif", "LIKE", "%$terms%")
				      ->orWhere("city", "LIKE", "%$terms%")
				      ->orWhere("state", "LIKE", "%$terms%")
				      ->orWhere("ein", "LIKE", "%$terms%");
			}
		})->orderBy('created_at','desc')->get();

		$result = array();
		$i = 0;
		foreach ($org_result as $o){
			if($o->id != $my_id){
				$result[$i]['id'] = $o->id;
				if($o->user_role == 'organization'){
					$result[$i]['name'] = $o->org_name;
				}else{
					$result[$i]['name'] = $o->first_name.' '.$o->last_name;
				}
				$result[$i]['user_role'] = $o->user_role;
				$result[$i]['logo_img'] = $o->logo_img;
				$result[$i]['city'] = $o->city;
				$result[$i]['state'] = $o->state;
				$result[$i]['country'] = $o->country;
				$friend = Friend::where('user_id',$my_id)->where('friend_id',$o->id)->where('is_deleted','<>',1)->get()->first();
				if($friend == null){
					$result[$i]['is_friend'] = 0;
				}else{
					$result[$i]['is_friend'] = $friend->status;
				}
				$result[$i]['is_followed'] = Follow::where('follower_id',$my_id)->where('type','organization')->where('followed_id',$o->id)->where('is_deleted','<>',1)->count();
				$i++;
			}
		}

		$group_result = Group::where('is_deleted','<>',1)->where(function ($query) use ($keyword) {
			$keyword_terms = explode(' ',$keyword);
			foreach ($keyword_terms as $terms){
				$query->orWhere("name", "LIKE","%$terms%")
				      ->orWhere("contact_name", "LIKE", "%$terms%")
				      ->orWhere("description", "LIKE", "%$terms%");
			}
		})->orderBy('created_at','desc')->get();
		$result1 = array();
		$j = 0;
		foreach($group_result as $g){
			$result1[$j]['id'] = $g->id;
			$result1[$j]['name'] = $g->name;
			$result1[$j]['user_role'] = 'group';
			$result1[$j]['logo_img'] = $g->logo_img;
			$result1[$j]['city'] = '';
			$result1[$j]['state'] = '';
			$result1[$j]['country'] = '';
//			$result1[$j]['created_at'] = $g->created_at;
			$friend = Group_member::where('user_id',$my_id)->where('group_id',$g->id)->where('is_deleted','<>',1)->get()->first();
			if($friend == null){
				$result1[$j]['is_friend'] = 0;
			}else{
				$result1[$j]['is_friend'] = $friend->status;
			}
			$result1[$j]['is_followed'] = Follow::where('follower_id',$my_id)->where('type','group')->where('followed_id',$g->id)->where('is_deleted','<>',1)->count();
			$j++;
		}
		$search_result = array_merge($result,$result1);
		return view('organization.search',['keyword'=>$keyword,'result'=>$search_result,'page_name'=>'']);
	}

	public function followOrganization(Request $request){
		$id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Follow::where('follower_id',$my_id)->where('type','organization')->where('followed_id',$id)->get()->first();
		if($is_exist == null){
			$follower = new Follow;
			$follower->follower_id = $my_id;
			$follower->type = 'organization';
			$follower->followed_id = $id;
			$follower->save();
		}else{
			$is_exist->is_deleted = 0;
			$is_exist->save();
		}
		$alert = new Alert;
		$alert->receiver_id = $id;
		$alert->sender_id = $my_id;
		$alert->sender_type = 'organization';
		$alert->alert_type = Alert::ALERT_FOLLOW;
		$alert->contents = ' followed you!';
		$alert->save();
		return Response::json(['result'=>'success']);
	}

	public function unfollowOrganization(Request $request){
		$id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Follow::where('follower_id',$my_id)->where('type','organization')->where('followed_id',$id)->get()->first();
		$is_exist->is_deleted = 1;
		$is_exist->save();

		$alert = new Alert;
		$alert->receiver_id = $id;
		$alert->sender_id = $my_id;
		$alert->sender_type = 'organization';
		$alert->alert_type = Alert::ALERT_FOLLOW;
		$alert->contents = ' unfollowed you!';
		$alert->save();
		return Response::json(['result'=>'success']);
	}

	public function connectOrganization(Request $request){
		$id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Friend::where('user_id',$my_id)->where('friend_id',$id)->get()->first();
		if($is_exist == null){
			$mine = new Friend;
			$mine->user_id = $my_id;
			$mine->friend_id = $id;
			$mine->status = Friend::FRIEND_PENDING;
			$mine->save();

			$friend = new Friend;
			$friend->user_id = $id;
			$friend->friend_id = $my_id;
			$friend->status = Friend::FRIEND_GET_REQUEST;
			$friend->save();
		}else{
			$is_exist->status = Friend::FRIEND_PENDING;
			$is_exist->is_deleted = 0;
			$is_exist->save();

			$friend = Friend::where('user_id',$id)->where('friend_id',$my_id)->get()->first();
			$friend->is_deleted = 0;
			$friend->status = Friend::FRIEND_GET_REQUEST;
			$friend->save();
		}

		$alert = new Alert;
		$alert->receiver_id = $id;
		$alert->sender_id = $my_id;
		$alert->sender_type = 'organization';
		$alert->alert_type = Alert::ALERT_CONNECT_CONFIRM_REQUEST;
		$alert->contents = ' want keep connection with you.';
		$alert->save();
		return Response::json(['result'=>'success']);
	}

	public function acceptFriend(Request $request){
		$id = $request->input('id');
		$my_id = Auth::user()->id;
		$mine = Friend::where('user_id',$my_id)->where('friend_id',$id)->get()->first();
		$mine->status = Friend::FRIEND_APPROVED;
		$mine->save();

		$friend = Friend::where('user_id',$id)->where('friend_id',$my_id)->get()->first();
		$friend->status = Friend::FRIEND_APPROVED;
		$friend->save();

		$alert = new Alert;
		$alert->receiver_id = $id;
		$alert->sender_id = $my_id;
		$alert->sender_type = 'organization';
		$alert->alert_type = Alert::ALERT_ACCEPT;
		$alert->contents = ' accept connection.';
		$alert->save();
		return Response::json(['result'=>'success']);
	}
}
