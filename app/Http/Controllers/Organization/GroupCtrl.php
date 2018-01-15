<?php

namespace App\Http\Controllers\Organization;

use App\Follow;
use App\Friend;
use App\Group;
use App\Group_member;
use App\Group_member_role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Illuminate\Support\Facades\Response;

class GroupCtrl extends Controller
{
	public function viewGroupPage(){
		$user_id = Auth::user()->id;
		$group = Group_member::where('user_id',$user_id)->where('status',Group_member::APPROVED)->where('is_deleted','<>',1)->get();
		$i = 0;
		$my_groups = array();
		foreach ($group as $g){
			$group_info = Group::find($g->group_id);
			$my_groups[$i]['group_id'] = $g->group_id;
			$my_groups[$i]['group_name'] = $group_info->name;
			$my_groups[$i]['group_member'] = Group_member::where('group_id',$g->group_id)->where('status',Group_member::APPROVED)->count();
			if($g->role_id == 1)
				$my_groups[$i]['group_role'] = 'Administrator';
			else
				$my_groups[$i]['group_role'] = 'Member';
			$my_groups[$i]['group_logo'] = Group::find($g->group_id)->logo_img;
			$i++;
		}
		return view('organization.groups',['info'=>$my_groups,'page_name'=>'org_group']);
	}

	public function viewGroupAddPage($id = null){
		if($id == null)
			return view('organization.create_group',['group_id'=>$id,'page_name'=>'org_group']);
		else{
			$group = Group::find($id);
			return view('organization.create_group',['group_id'=>$id,'group_info'=>$group,'page_name'=>'org_group']);
		}
	}
	
	public function createGroup(Request $request){
		$user_id = Auth::user()->id;
		$group_name = $request->get('group_name');
		$description = $request->get('description');
		$contact_name = $request->get('contact_name');
		$contact_email = $request->get('contact_email');
		$contact_phone = $request->get('contact_phone');

		$group = new Group;
		$group->creator_id = $user_id;
		$group->name = $group_name;
		$group->description = $description;
		$group->contact_name = $contact_name;
		$group->contact_email = $contact_email;
		$group->contact_phone = $contact_phone;
		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');
			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$group->logo_img = $name;
		}

		$group->save();

		$group_member = new Group_member;
		$group_member->group_id = $group->id;
		$group_member->user_id = $user_id;
		$group_member->role_id = Group::GROUP_ADMIN;
		$group_member->status = Group_member::APPROVED;
		$group_member->save();

		return redirect()->to('/organization/group');
	}

	public function changeGroup(Request $request){
		$group_id = $request->get('group_id');
		$group_name = $request->get('group_name');
		$description = $request->get('description');
		$contact_name = $request->get('contact_name');
		$contact_email = $request->get('contact_email');
		$contact_phone = $request->get('contact_phone');

		$group = Group::find($group_id);
		$group->name = $group_name;
		$group->description = $description;
		$group->contact_name = $contact_name;
		$group->contact_email = $contact_email;
		$group->contact_phone = $contact_phone;
		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');
			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$group->logo_img = $name;
		}

		$group->save();
		return redirect()->to('/organization/group');
	}

	public function removeGroup(){
		
	}

	public function viewGroupDetail($group_id){

		$group_info = array();
		$group = Group::find($group_id);
		$group_info['group_id'] = $group->id;
		$my_group = Group_member::where('group_id',$group_id)->where('user_id',Auth::user()->id)->where('is_deleted','<>',1)->get()->first();
		if($my_group == null){
			$group_info['is_my_group'] = 0;
		}else{
			$group_info['is_my_group'] = $my_group->status;
		}
		$my_follow = Follow::where('follower_id',Auth::user()->id)->where('type','group')->where('followed_id',$group_id)->where('is_deleted','<>',1)->get()->first();
		if($my_follow == null){
			$group_info['is_followed'] = 0;
		}else{
			$group_info['is_followed'] = 1;
		}
		$group_info['group_name'] = $group->name;
		$group_info['group_logo'] = $group->logo_img;
		$group_info['group_description'] = $group->description;
		$group_info['group_contact_name'] = $group->contact_name;
		$group_info['group_contact_email'] = $group->contact_email;
		$group_info['group_contact_number'] = $group->contact_phone;
		$created_at = explode(" ",$group->created_at);
		$group_info['group_created_at'] = $created_at[0];
		$creator = User::find($group->creator_id);
		$group_info['org_id'] = $creator->id;
		$group_info['org_name'] = $creator->org_name;
		$group_info['org_logo'] = $creator->logo_img;

		$member_info = array();
		$group_members = Group_member::where('group_id',$group_id)->where('status',Group_member::APPROVED)->where('is_deleted','<>',1)->get();
		foreach ($group_members as $gm){
			$member_info[$gm->id]['user_role'] = $gm->role_id;
			$member_info[$gm->id]['member_id'] = $gm->user_id;
			$member = User::find($gm->user_id);
			if($member->user_role == 'organization'){
				$member_info[$gm->id]['member_name'] = $member->org_name;
				$member_info[$gm->id]['group'] = 'Organization';
			}else{
				$member_info[$gm->id]['member_name'] = $member->first_name.' '.$member->last_name;
			}
			$member_info[$gm->id]['member_logo'] = $member->logo_img;
			$member_info[$gm->id]['member_email'] = $member->email;
			$member_info[$gm->id]['member_number'] = $member->contact_number;
		}
		return view('organization.view_group_detail',['group_info'=>$group_info,'member_info'=>$member_info,'page_name'=>'']);
	}
	
	public function searchGroup(Request $request){
		$keyword = $request->input('keyword');
		$my_id = Auth::user()->id;
		$my_group_ids = Group_member::where('user_id',$my_id)->where('status',Group_member::APPROVED)->where('is_deleted','<>',1)->groupBy('group_id')->selectRaw('group_id')->pluck('group_id')->toArray();
		if($keyword == null){
			$friend_id = Friend::where('user_id',$my_id)->where('status',Friend::FRIEND_APPROVED)->pluck('friend_id')->toArray();
			$group_ids = Group_member::whereIn('user_id',$friend_id)->where('status',Group_member::APPROVED)->groupBy('group_id')->selectRaw('group_id')->pluck('group_id')->toArray();
			$groups = Group::whereIn('id',$group_ids)->whereNotIn('id',$my_group_ids)->get();
			$result = array();
			$i = 0;
			foreach ($groups as $g){
				$result[$i]['group_id'] = $g->id;
				$result[$i]['group_name'] = $g->name;
				$result[$i]['group_logo'] = $g->logo_img;
				$result[$i]['owner_id'] = $g->creator_id;
				if(User::find($g->creator_id)->user_role == 'organization'){
					$result[$i]['owner_name'] = User::find($g->creator_id)->org_name;
				}else{
					$result[$i]['owner_name'] = User::find($g->creator_id)->first_name.' '.User::find($g->creator_id)->last_name;
				}
				$result[$i]['members'] = Group_member::where('group_id',$g->id)->where('is_deleted','<>',1)->count();
				$result[$i]['is_followed'] = Follow::where('follower_id',$my_id)->where('type','group')->where('followed_id',$g->id)->where('is_deleted','<>',1)->count();
				$result[$i]['status'] = 0;
				$is_member = Group_member::where('group_id',$g->id)->where('user_id',$my_id)->where('is_deleted','<>',1)->get()->first();
				if($is_member != null){
					$result[$i]['status'] = $is_member->status;
				}
				$i++;
			}
			return view('organization.group_search',['groups'=>$result,'keyword'=>$keyword,'page_name'=>'org_group']);
		}else{
			$groups = Group::whereNotIn('id',$my_group_ids)->where('is_deleted','<>',1)->where(function ($query) use ($keyword) {
				$keyword_terms = explode(' ',$keyword);
				foreach ($keyword_terms as $terms){
					$query->orWhere("name", "LIKE","%$terms%")
						->orWhere("description", "LIKE", "%$terms%");
				}
			})->orderBy('created_at','desc')->get();
			$result = array();
			$i = 0;
			foreach ($groups as $g){
				$result[$i]['group_id'] = $g->id;
				$result[$i]['group_name'] = $g->name;
				$result[$i]['group_logo'] = $g->logo_img;
				$result[$i]['owner_id'] = $g->creator_id;
				if(User::find($g->creator_id)->user_role == 'organization'){
					$result[$i]['owner_name'] = User::find($g->creator_id)->org_name;
				}else{
					$result[$i]['owner_name'] = User::find($g->creator_id)->first_name.' '.User::find($g->creator_id)->last_name;
				}
				$result[$i]['members'] = Group_member::where('group_id',$g->id)->where('is_deleted','<>',1)->count();
				$result[$i]['is_followed'] = Follow::where('follower_id',$my_id)->where('type','group')->where('followed_id',$g->id)->where('is_deleted','<>',1)->count();
				$result[$i]['status'] = 0;
				$is_member = Group_member::where('group_id',$g->id)->where('user_id',$my_id)->where('is_deleted','<>',1)->get()->first();
				if($is_member != null){
					$result[$i]['status'] = $is_member->status;
				}
				$i++;
			}
			return view('organization.group_search',['groups'=>$result,'keyword'=>$keyword,'page_name'=>'org_group']);
		}
	}

	public function followGroup(Request $request){
		$group_id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Follow::where('follower_id',$my_id)->where('type','group')->where('followed_id',$group_id)->get()->first();
		if($is_exist == null){
			$follower = new Follow;
			$follower->follower_id = $my_id;
			$follower->type = 'group';
			$follower->followed_id = $group_id;
			$follower->save();
		}else{
			$is_exist->is_deleted = 0;
			$is_exist->save();
		}
		return Response::json(['result'=>'success']);
	}

	public function unfollowGroup(Request $request){
		$group_id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Follow::where('follower_id',$my_id)->where('type','group')->where('followed_id',$group_id)->get()->first();
		$is_exist->is_deleted = 1;
		$is_exist->save();
		return Response::json(['result'=>'success']);
	}

	public function jointoGroup(Request $request){
		$group_id = $request->input('id');
		$my_id = Auth::user()->id;
		$is_exist = Group_member::where('group_id',$group_id)->where('user_id',$my_id)->get()->first();
		if($is_exist == null){
			$member = new Group_member;
			$member->group_id = $group_id;
			$member->user_id = $my_id;
			$member->role_id = Group_member_role::MEMBER;
			$member->status = Group_member::PENDING;
			$member->save();
		}else{
			$is_exist->is_deleted = 1;
			$is_exist->status = Group_member::PENDING;
			$is_exist->save();
		}
	}
    //
}
