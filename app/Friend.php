<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
	const FRIEND_PENDING = 1;
	const FRIEND_APPROVED = 2;
	const FRIEND_GET_REQUEST = 3;

	public $timestamps = true;
    //
}
