<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Friend;
use App\Group_member;
use App\Message;
use App\Opportunity_member;
use App\Tracking;
use App\User;
use App\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
class SharingCtrl extends Controller
{
	public function sharedProfilePage($id)
	{
		$user = User::find($id);
		$today = date("Y-m-d");
		if($user->user_role == 'volunteer'){
			$user_id = $user->id;
			$logged_hours = Tracking::where('volunteer_id',$user_id)->where('is_deleted','<>',1)->where('approv_status',1)->sum('logged_mins');
			$logged_hours = $logged_hours/60;

			$today = date('Y-m-d');
			$my_opportunities = Opportunity_member::where('user_id',$user_id)->where('is_deleted','<>',1)->pluck('oppor_id')->toArray();
			$opportunities = Opportunity::whereIn('id',$my_opportunities)->where('type',1)->where('is_deleted','<>',1)->
			where('end_date','>',$today)->get();

			$groups = DB::table('groups')->join('group_members','groups.id','=','group_members.group_id')->where('group_members.user_id',$user_id)->
			where('group_members.is_deleted','<>',1)->where('groups.is_deleted','<>',1)->select('groups.*','group_members.role_id')->get();

			$friends = DB::table('users')->join('friends','users.id','=','friends.friend_id')->where('friends.user_id',$user_id)->
			where('friends.is_deleted','<>',1)->where('users.is_deleted','<>',1)->where('users.confirm_code',1)->select('users.*')->get();

			return view('sharedprofile',['user_info'=>$user,'opportunity'=>$opportunities,'group'=>$groups,'friend'=>$friends,'logged_hours'=>$logged_hours,'user_role'=>'volunteer']);
		}else{
			$tracks_hours = Tracking::where('org_id',$id)->where('approv_status',1)->where('is_deleted','<>',1)->sum('logged_mins');
			$tracks_hours = $tracks_hours/60;

			$today = date("Y-m-d");
			$active_oppr = Opportunity::where('org_id',$id)->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)->orderBy('created_at','desc')->get();

			$groups = DB::table('groups')->join('group_members','groups.id','=','group_members.group_id')->where('group_members.user_id',$id)->
			where('group_members.is_deleted','<>',1)->where('groups.is_deleted','<>',1)->select('groups.*','group_members.role_id')->get();

			$my_members = DB::table('opportunity_members')->where('opportunity_members.org_id',$id)->where('opportunity_members.is_deleted','<>',1)->
			join('users','opportunity_members.user_id','=','users.id')->select('users.*')->get();
			$members = array();
			foreach ($my_members as $m){
				$members[$m->id] = $m;
			}
			return view('sharedprofile',['user_info'=>$user,'tracks_hours'=>$tracks_hours,'active_oppr'=>$active_oppr,'group'=>$groups,'members'=>$members,'user_role'=>'organization']);
		}
	}

	public function shareProfile(Request $request){
		$user = Auth::user();
		$emails = $request->input('emails');
		$comments = $request->input('comments');
		$shr_email = explode(',',$emails);
		if($user->user_role == 'volunteer'){
			for($i = 0; $i< count($shr_email); $i++){
				$email = $shr_email[$i];
				Mail::send('emails.shareProfile', ['user_type' => 1,'info' => $user, 'content' => $comments], function ($message) use($user,$email)
				{
					$name = $user->first_name.' '.$user->last_name;
					$message->from('support@myvoluntier.com', 'MyVoluntier.com');
					$message->to($email);
					$message->replyTo($user->email, $name);
					$message->subject($name.' shared profile on MyVoluntier.com');
				});
			}
		}else{
			for($i = 0; $i< count($shr_email); $i++){
				$email = $shr_email[$i];
				Mail::send('emails.shareProfile', ['user_type' => 0,'info' => $user, 'content' => $comments], function ($message) use($user,$email)
				{
					$message->from('support@myvoluntier.com', 'MyVoluntier.com');
					$message->to($email);
					$message->replyTo($user->email, $user->org_name);
					$message->subject($user->org_name.' shared profile of MyVoluntier.com');
				});
			}
		}
		return Response::json(['result'=>'success']);
	}


	public function sendRequest(Request $request){
		$first_name = $request->input('first_name');
		$last_name = $request->input('last_name');
		$org_name = $request->input('org_name');
		$email = $request->input('email');
		$phone = $request->input('phone');
		$comment = $request->input('comment');

		Mail::send('emails.sendRequest', ['first_name'=>$first_name,'last_name'=>$last_name,'org_name'=>$org_name,'email'=>$email,'phone'=>$phone,'comment'=>$comment], function ($message) use($first_name,$last_name,$email)
		{
			$name = $first_name.' '.$last_name;
			$message->from('support@myvoluntier.com', $name);
			$message->to('support@myvoluntier.com');
			$message->replyTo($email, $name);
			$message->subject($name.' sent Request');
		});
		return Response::json(['result'=>'success']);
	}

	public function getMessage(Request $request){
		$result = Message::where('receiver_id',$request->input('user_id'))->where('is_read',0)->get();
		return Response::json(['result'=>$result]);
	}

	public function getAlert(Request $request){
		$result = Alert::where('receiver_id',$request->input('user_id'))->where('is_checked',0)->count();
		return Response::json(['result'=>$result]);
	}

	public function viewAlertPage(){
		$user = Auth::user();
		$alerts = Alert::where('receiver_id',$user->id)->orderBy('created_at','desc')->get();
		foreach($alerts as $a){
			$a->is_checked = 1;
			$a->save();
		}
		$alert_contents = array();
		if($user->user_role == 'volunteer'){
			foreach($alerts as $a){
				$sender = User::find($a->sender_id);
				$alert_contents[$a->id]['sender_id'] = $a->sender_id;
				$alert_contents[$a->id]['alert_type'] = $a->alert_type;
				$alert_contents[$a->id]['contents'] = $a->contents;
				$alert_contents[$a->id]['is_checked'] = $a->is_checked;
				$alert_contents[$a->id]['sender_logo'] = $sender->logo_img;
				$alert_contents[$a->id]['sender_type'] = $a->sender_type;
				$alert_contents[$a->id]['status'] = 0;
				if($a->alert_type == Alert::ALERT_CONNECT_CONFIRM_REQUEST){
					$friend = Friend::where('user_id',$a->sender_id)->where('friend_id',$user->id)->where('is_deleted','<>',1)->where('status',Friend::FRIEND_APPROVED)->get()->first();
					if($friend != null){
						$alert_contents[$a->id]['status'] = 1;
					}
				}
				$alert_contents[$a->id]['date'] = $a->created_at;
				if($a->sender_type == 'volunteer'){
					$alert_contents[$a->id]['sender_name'] = $sender->first_name.' '.$sender->last_name;
				}elseif($a->sender_type == 'organization'){
					$alert_contents[$a->id]['sender_name'] = $sender->org_name;
				}
			}
			return view('volunteer.alert',['alert'=>$alert_contents,'page_name'=>'']);
		}else{
			foreach($alerts as $a){
				$sender = User::find($a->sender_id);
				$alert_contents[$a->id]['sender_id'] = $a->sender_id;
				$alert_contents[$a->id]['alert_type'] = $a->alert_type;
				$alert_contents[$a->id]['contents'] = $a->contents;
				$alert_contents[$a->id]['is_checked'] = $a->is_checked;
				$alert_contents[$a->id]['sender_logo'] = $sender->logo_img;
				$alert_contents[$a->id]['sender_type'] = $a->sender_type;
				$alert_contents[$a->id]['status'] = 0;
				if($a->alert_type == Alert::ALERT_CONNECT_CONFIRM_REQUEST){
					$friend = Friend::where('user_id',$a->sender_id)->where('friend_id',$user->id)->where('is_deleted','<>',1)->where('status',Friend::FRIEND_APPROVED)->get()->first();
					if($friend != null){
						$alert_contents[$a->id]['status'] = 1;
					}
				}
				$alert_contents[$a->id]['date'] = $a->created_at;
				if($a->sender_type == 'volunteer'){
					$alert_contents[$a->id]['sender_name'] = $sender->first_name.' '.$sender->last_name;
				}elseif($a->sender_type == 'organization'){
					$alert_contents[$a->id]['sender_name'] = $sender->org_name;
				}
			}
			return view('organization.alert',['alert'=>$alert_contents,'page_name'=>'']);
		}
	}
    //
}
