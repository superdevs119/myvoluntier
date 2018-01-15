<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'org_name',
        'first_name',
        'last_name',
        'user_name',
        'logo_img',
        'back_img',
        'user_role',
        'email',
        'password',
        'birth_date',
        'gender',
        'zipcode',
        'location',
        'lat',
        'lng',
        'contact_number',
        'brif',
        'website',
        'org_type',
        'remember_token',
        'forgot_status'.
        'status',
        'is_deleted'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'type_name',
        'oppr_count',
    ];
    public function getTypeNameAttribute(){
        if($this->user_role == 'organization'){
            $org_type_name = Organization_type::where('id', $this->org_type)->get()->first();
            return $org_type_name->organization_type;
        }
        else
            return '';
    }
    public function getOpprCountAttribute(){
        $today = date("Y-m-d");
        $count = Opportunity::where('org_id',$this->id)->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)->count();
        return $count;
    }
}
