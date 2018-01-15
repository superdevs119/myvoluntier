<?php

namespace App\Http\Controllers\Volunteer;

use App\Activity;
use App\Alert;
use App\Opportunity;
use App\Opportunity_member;
use App\Tracking;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;

class TrackingCtrl extends Controller
{
	public function viewTrackingPage(Request $request){
		$user_id = Auth::user()->id;
		$oppr_mem = Opportunity_member::where('user_id',$user_id)->where('is_deleted','<>',1)->pluck('oppor_id')->toArray();
		$today = date("Y-m-d");
		$oppr = Opportunity::where('end_date','>=',$today)->where('is_deleted','<>',1)->whereIn('id',$oppr_mem)->get();
		$org_name = User::where('user_role','organization')->where('is_deleted','<>',1)->where('status','<>',1)->get(['id','org_name']);
		$tracks = Tracking::where('volunteer_id',$user_id)->where('is_deleted','<>',1)->orderBy('updated_at','desc')->get();
		$today = date("Y-m-d");
		$week_date = date('Y-m-d',strtotime($today."-7 days"));
		$week_date = $week_date.' 00:00:00';
		$activity = Activity::where('user_id',$user_id)->where('is_deleted','<>',1)->where('updated_at','>=',$week_date)->orderBy('updated_at','desc')->get();
		foreach ($tracks as $tr){
			if($tr->oppor_id == 0){
				$tr['opp_logo'] = '';
				$tr['opp_type'] = '';
				$ud = explode(" ",$tr->updated_at);
				$tr['updated_date'] = $ud[0];
			}else{
				$opp_info = Opportunity::find($tr->oppor_id);
				$tr['opp_logo'] = $opp_info->logo_img;
				$tr['opp_type'] = $opp_info->type;
				$ud = explode(" ",$tr->updated_at);
				$tr['updated_date'] = $ud[0];
			}
		}
		return view('volunteer.track',['oppr'=>$oppr,'tracks'=>$tracks,'activity'=>$activity,'org_name'=>$org_name,'page_name'=>'vol_track']);
	}

	public function viewSingleTrackingPage(Request $request){
		$user_id = Auth::user()->id;
		$oppr_mem = Opportunity_member::where('user_id',$user_id)->where('is_deleted','<>',1)->pluck('oppor_id')->toArray();
		$today = date("Y-m-d");
		$oppr = Opportunity::where('end_date','>=',$today)->where('is_deleted','<>',1)->whereIn('id',$oppr_mem)->get();
		$org_name = User::where('user_role','organization')->where('is_deleted','<>',1)->where('status','<>',1)->get(['id','org_name']);
		return view('volunteer.singletrack',['oppr'=>$oppr,'org_name'=>$org_name,'page_name'=>'']);
	}

	public function getOpportunityNames(Request $request){
		$org_id = $request->input('org_id');
		$today = date("Y-m-d");
		$oppors = Opportunity::where('org_id',$org_id)->where('is_deleted','<>','1')->where('type',1)->where('end_date','>=',$today)->get();
		return Response::json(['oppor'=>$oppors]);
	}

	public function joinToOpportunity(Request $request){
		$is_opp_exist = $request->input('is_opp_exist');
		$org_id = $request->input('org_id');
		$opp_id = $request->input('opp_id');
		$end_date =  date("Y-m-d", strtotime($request->input('end_date')));
		$org_email = $request->input('org_email');
		$private_opp_title = $request->input('private_opp');
		$user_id = Auth::user()->id;
		if($is_opp_exist == 1){
			$is_mem_exist = Opportunity_member::where('oppor_id',$opp_id)->where('user_id',$user_id)->count();
			if($is_mem_exist > 0){
				return Response::json(['result'=>'already exist']);
			}else{
				$opp_mem = new Opportunity_member;
				$opp_mem->oppor_id = $opp_id;
				$opp_mem->user_id = $user_id;
				$opp_mem->org_id = $org_id;
				$opp_mem->save();

				$add_activity = new Activity;
				$add_activity->user_id = $user_id;
				$add_activity->oppor_id = $opp_id;
				$add_activity->oppor_title = Opportunity::find($opp_id)->title;
				$add_activity->content = "You Joined on Opportunity ";
				$add_activity->type = Activity::ACTIVITY_JOIN_OPPORTUNITY;
				$add_activity->save();

				$opp_logo = Opportunity::find($opp_id)->logo_img;
				return Response::json(['result'=>'public opportunity added','opp_logo'=>$opp_logo]);
			}
		}else{
			$private_opp = new Opportunity;
			$private_opp->org_id = $org_id;
			$private_opp->org_type = User::find($org_id)->org_type;
			$private_opp->title = $private_opp_title;
			$private_opp->type = 2;
			$private_opp->end_date = $end_date;
			$private_opp->save();

			$add_activity = new Activity;
			$add_activity->user_id = $user_id;
			$add_activity->oppor_id = $private_opp->id;
			$add_activity->oppor_title = $private_opp_title;
			$add_activity->content = "You created Private Opportunity ";
			$add_activity->type = Activity::ACTIVITY_CREATE_PRIVATE_OPPORTUNITY;
			$add_activity->save();

			$opp_mem = new Opportunity_member;
			$opp_mem->oppor_id = $private_opp->id;
			$opp_mem->user_id = $user_id;
			$opp_mem->org_id = $org_id;
			$opp_mem->save();

			$add_activity = new Activity;
			$add_activity->user_id = $user_id;
			$add_activity->oppor_id = $private_opp->id;
			$add_activity->oppor_title = $private_opp_title;
			$add_activity->content = "You Joined on Private Opportunity ";
			$add_activity->type = Activity::ACTIVITY_JOIN_OPPORTUNITY;
			$add_activity->save();
			return Response::json(['result'=>'private opportunity added','opp_id'=>$private_opp->id]);
		}
	}

	public function addHours(Request $request){
		$opp_id = $request->input('opp_id');
		$opp_name = $request->input('opp_name');
		$volunteer_id = Auth::user()->id;
		$start_time = $request->input('start_time');
		$end_time = $request->input('end_time');
		$logged_mins = $request->input('logged_mins');
		$logged_date = $request->input('selected_date');
		$comments = $request->input('comments');
		$is_edit = $request->input('is_edit');
		$tracking_id = $request->input('tracking_id');
		$is_no_org = $request->input('is_no_org');
		$org_email = $request->input('org_email');
		$private_opp_name = $request->input('private_opp_name');

		if($is_no_org == 1){
			if($is_edit == 0){
				$tracks = new Tracking;
				$tracks->volunteer_id = $volunteer_id;
				$tracks->oppor_name = $private_opp_name;
				$tracks->started_time = $start_time;
				$tracks->ended_time = $end_time;
				$tracks->logged_mins = $logged_mins;
				$tracks->logged_date = $logged_date;
				$tracks->description = $comments;
				$tracks->confirm_code = str_random(30);
				$tracks->save();

				$add_activity = new Activity;
				$add_activity->user_id = $volunteer_id;
				$add_activity->oppor_id = 0;
				$add_activity->oppor_title = $private_opp_name;
				$add_activity->content = "You Added ".$logged_mins."mins on Opportunity ";
				$add_activity->type = Activity::ACTIVITY_ADD_HOURS;
				$add_activity->save();

				$this->sendConfirmEmail($org_email, $tracks->id, $tracks->confirm_code);
			}else{
				$tracks = Tracking::find($tracking_id);
				if($tracks->approv_status == 1){
					return Response::json(['result'=>'approved track']);
				}
				if($tracks->approv_status == 2){
					return Response::json(['result'=>'declined track']);
				}
				$tracks->oppor_name = $private_opp_name;
				$tracks->started_time = $start_time;
				$tracks->ended_time = $end_time;
				$tracks->logged_mins = $logged_mins;
				$tracks->logged_date = $logged_date;
				$tracks->description = $comments;
				$tracks->save();

				$add_activity = new Activity;
				$add_activity->user_id = $volunteer_id;
				$add_activity->oppor_id = 0;
				$add_activity->oppor_title =$private_opp_name;
				$add_activity->content = "You Updated Logged Hours to".$logged_mins."mins on Opportunity ";
				$add_activity->type = Activity::ACTIVITY_ADD_HOURS;
				$add_activity->save();
			}
			$opp_logo = null;
			$is_link = 0;
		}else{
			if($is_edit == 0){
				$tracks = new Tracking;
				$tracks->volunteer_id = $volunteer_id;
				$tracks->oppor_id = $opp_id;
				$is_link = Opportunity::find($opp_id)->type;
				if($is_link == 1){
					$tracks->link = 1;
				}
				$tracks->oppor_name = $opp_name;
				$tracks->org_id = Opportunity::find($opp_id)->org_id;
				$tracks->started_time = $start_time;
				$tracks->ended_time = $end_time;
				$tracks->logged_mins = $logged_mins;
				$tracks->logged_date = $logged_date;
				$tracks->description = $comments;
				$tracks->save();

				$add_activity = new Activity;
				$add_activity->user_id = $volunteer_id;
				$add_activity->oppor_id = $opp_id;
				if($is_link == 1){
					$add_activity->link = 1;
				}
				$add_activity->oppor_title = $opp_name;
				$add_activity->content = "You Added ".$logged_mins."mins on Opportunity ";
				$add_activity->type = Activity::ACTIVITY_ADD_HOURS;
				$add_activity->save();

				$alert = new Alert;
				$alert->receiver_id = $tracks->org_id;
				$alert->sender_id = $volunteer_id;
				$alert->sender_type = 'volunteer';
				$alert->alert_type = Alert::ALERT_TRACK_CONFIRM_REQUEST;
				$alert->contents = ' asking confirm logged hours on your opportunity.';
				$alert->save();
			}else{
				$tracks = Tracking::find($tracking_id);
				if($tracks->approv_status == 1){
					return Response::json(['result'=>'approved track']);
				}
				$tracks->oppor_id = $opp_id;
				$is_link = Opportunity::find($opp_id)->type;
				if($is_link == 1){
					$tracks->link = 1;
				}
				$tracks->oppor_name = $opp_name;
				$tracks->org_id = Opportunity::find($opp_id)->org_id;
				$tracks->started_time = $start_time;
				$tracks->ended_time = $end_time;
				$tracks->logged_mins = $logged_mins;
				$tracks->logged_date = $logged_date;
				$tracks->description = $comments;
				$tracks->save();

				$add_activity = new Activity;
				$add_activity->user_id = $volunteer_id;
				$add_activity->oppor_id = $opp_id;
				if($is_link == 1){
					$add_activity->link = 1;
				}
				$add_activity->oppor_title =$opp_name;
				$add_activity->content = "You Updated Logged Hours to".$logged_mins."mins on Opportunity ";
				$add_activity->type = Activity::ACTIVITY_ADD_HOURS;
				$add_activity->save();


			}
			$opp_logo = Opportunity::find($opp_id)->logo_img;
		}
		return Response::json(['result'=>'success','track_id'=>$tracks->id,'opp_logo'=>$opp_logo,'is_link_exist'=>$is_link]);
	}

	public function viewTracks(){
		$user_id = Auth::user()->id;
		$tracks = Tracking::where('volunteer_id',$user_id)->where('is_deleted','<>',1)->get();
		$tracked_history = array();
		$i = 0;
		foreach ($tracks as $t){
			if($t->oppor_id == 0){
				$tracked_history[$i]['id'] = $t->id;
				$tracked_history[$i]['opp_id'] = 0;
				$tracked_history[$i]['title'] = $t->oppor_name;
				$tracked_history[$i]['start'] = $t->logged_date.' '.$t->started_time;
				$tracked_history[$i]['end'] = $t->logged_date.' '.$t->ended_time;
				$tracked_history[$i]['comments'] = $t->description;
				$tracked_history[$i]['link'] = 0;
				$i++;
			}else{
				$tracked_history[$i]['id'] = $t->id;
				$tracked_history[$i]['opp_id'] = $t->oppor_id;
				$tracked_history[$i]['title'] = Opportunity::find($t->oppor_id)->title;
				$tracked_history[$i]['start'] = $t->logged_date.' '.$t->started_time;
				$tracked_history[$i]['end'] = $t->logged_date.' '.$t->ended_time;
				$tracked_history[$i]['comments'] = $t->description;
				$is_link = Opportunity::find($t->oppor_id)->type;
				if($is_link == 1){
					$tracked_history[$i]['link'] = 1;
				}else{
					$tracked_history[$i]['link'] = 0;
				}
				$i++;
			}
		}
		return Response::json($tracked_history);
	}

	public function removeHours(Request $request){
		$user_id = Auth::user()->id;
		$track_id = $request->input('tracking_id');
		$target = Tracking::find($track_id);
		$opp_id = $target->oppor_id;
		$opp_title = $target->oppor_name;
		$is_link = 0;
		if($opp_id == 0){
			$opp_logo = null;
		}else{
			$opp_logo = Opportunity::find($opp_id)->logo_img;
			$is_link = Opportunity::find($opp_id)->type;
		}
		$target->is_deleted = 1;
		$target->save();

		$add_activity = new Activity;
		$add_activity->user_id = $user_id;
		$add_activity->oppor_id = $opp_id;
		if($is_link == 1){
			$add_activity->link = 1;
		}
		$add_activity->oppor_title = $opp_title;
		$add_activity->content = "You Removed Logged Hours on Opportunity ";
		$add_activity->type = Activity::ACTIVITY_REMOVE_HOURS;
		$add_activity->save();

		return Response::json(['result'=>$track_id,'opp_logo'=>$opp_logo,'is_link_exist'=>$is_link]);
	}

	public function activityView(Request $request){
		$range = $request->input('range');
		$date_range = '-'.$range.' days';
		$user_id = Auth::user()->id;
		$today = date("Y-m-d");
		$current_date = date('Y-m-d',strtotime($today.$date_range));
		if($range == 0){
			$current_date = date('Y-m-d',strtotime($today));
		}
		$current_date = $current_date.' 00:00:00';
		$activity = Activity::where('user_id',$user_id)->where('is_deleted','<>',1)->where('updated_at','>=',$current_date)->orderBy('updated_at','desc')->get();
		return Response::json(['activity'=>$activity]);
	}

	public function sendConfirmEmail($email, $track_id, $confirm_code){
		$user = Auth::user();
		Mail::send('emails.trackConfirm', ['user_info' => $user, 'track_id' => $track_id, 'confirm_code'=> $confirm_code], function ($message) use($user,$email)
		{
			$name = $user->first_name.' '.$user->last_name;
			$message->from('support@myvoluntier.com', 'MyVoluntier.com');
			$message->to($email);
			$message->replyTo($user->email, $name);
			$message->subject($name.' Ask confirming Added hours on MyVoluntier.com');
		});
		return 1;
	}
}
