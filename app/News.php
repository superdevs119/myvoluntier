<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
	const POSTED_NEWS = 1;
	const TRACKED_NEWS = 2;
	const CONFIRMED_NEWS = 3;
	const DECLINED_NEWS = 4;

	protected $table = 'news';

	protected $fillable = [
		'user_id',
		'title',
		'content',
		'logo_img',
	];
    //
}
