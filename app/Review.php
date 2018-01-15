<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $appends = [
		'org_name',
		'org_logo',
	];

	public function getOrgNameAttribute(){
		if($this->review_from != null){
			return User::find($this->review_from)->org_name;
		}else{
			return '';
		}
	}

	public function getOrgLogoAttribute(){
		if($this->review_from != null){
			return User::find($this->review_from)->logo_img;
		}else{
			return '';
		}
	}
    //
}
