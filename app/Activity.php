<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	const ACTIVITY_JOIN_OPPORTUNITY = 1;
	const ACTIVITY_ADD_HOURS = 2;
	const ACTIVITY_UPDATE_HOURS = 3;
	const ACTIVITY_REMOVE_HOURS = 4;
	const ACTIVITY_CREATE_PRIVATE_OPPORTUNITY = 5;
	const ACTIVITY_SEND_CONFIRM_REQUEST = 6;
	const ACTIVITY_RESEND_CONFIRM_REQUEST = 7;


	protected $table = 'activities';

	protected $fillable = [
		'user_id',
		'oppor_id',
		'content',
		'is_deleted',
	];

	public $timestamps = true;

	protected $appends = [
		'opp_logo',
	];

	public function getOppLogoAttribute(){
		if($this->oppor_id == 0){
			return null;
		}else{
			$logo = Opportunity::find($this->oppor_id)->logo_img;
			return $logo;
		}
	}
    //
}
