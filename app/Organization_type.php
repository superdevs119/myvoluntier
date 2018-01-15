<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization_type extends Model
{
	const EDUCATIONAL_INSTITUTION = 1;
	const NONPROFIT = 2;
	const NGO_NONPROFIT =3;
	const OTHER = 4;
	protected $table = 'organization_types';

    protected $fillable = [
	  'id', 'organization_type',
    ];

	public $timestamps = false;
}
