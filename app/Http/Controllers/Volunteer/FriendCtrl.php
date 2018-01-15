<?php

namespace App\Http\Controllers\Volunteer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendCtrl extends Controller
{
	public function viewFriendPage(){
		return view('volunteer.friend',['page_name'=>'vol_friend']);
	}
    //
}
