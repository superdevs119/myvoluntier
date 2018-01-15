<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
	const STATUS_PENDING = 0;
	const STATUS_APPROVE = 1;
	const STATUS_DECLINE = 2;
	
	protected $table = 'tracked_hours';

	protected $fillable = [
		'volunteer_id',
		'oppor_id',
		'org_id',
		'logged_date',
		'started_time',
		'ended_time',
		'logged_mins',
		'uploaded_file',
		'description',
		'approv_status',
		'is_disabled',
		'is_deleted'
	];

	protected $appends = [
		'org_name',
		'opp_name',
		'submitted_date',
	];

	public function getOrgNameAttribute(){
		if($this->org_id != null){
			$poster = User::find($this->org_id);
			return $poster->org_name;
		}else{
			return '';
		}
	}

	public function getOppNameAttribute(){
		if($this->oppor_id != null){
			$poster = Opportunity::find($this->oppor_id);
			return $poster->title;
		}else{
			return '';
		}
	}

	public function getSubmittedDateAttribute(){
		if($this->oppor_id != null){
			$poster = Opportunity::find($this->oppor_id);
			$created_at = $poster->created_at;
			$date = explode(' ',$created_at);
			$submitted_date = date('F j, Y',strtotime($date[0]));
			return $submitted_date;
		}else{
			return '';
		}
	}

	public $timestamps = true;
    //
}
