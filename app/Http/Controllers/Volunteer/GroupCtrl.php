<?php

namespace App\Http\Controllers\Volunteer;

use App\Follow;
use App\Group;
use App\Group_member;
use App\Group_member_role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
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
		return view('volunteer.groups',['info'=>$my_groups,'page_name'=>'vol_group']);
	}

	public function viewGroupAddPage($id = null){
		if($id == null)
			return view('volunteer.create_group',['group_id'=>$id,'page_name'=>'vol_group']);
		else{
			$group = Group::find($id);
			return view('volunteer.create_group',['group_id'=>$id,'group_info'=>$group,'page_name'=>'vol_group']);
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

		return redirect()->to('/volunteer/group');
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
