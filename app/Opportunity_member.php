<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity_member extends Model
{
	protected $table = 'opportunity_members';

	protected $fillable = [
		'oppor_id',
		'user_id',
		'org_id',
		'status',
		'is_deleted',
	];

	public $timestamps = true;
    //
}
