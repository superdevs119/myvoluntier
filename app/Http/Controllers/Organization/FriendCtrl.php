<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendCtrl extends Controller
{
	public function viewFriendPage(){
		return view('organization.friend',['page_name'=>'org_friend']);
	}
    //
}
