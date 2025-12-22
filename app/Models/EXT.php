<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class EXT extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    

    protected $table = 'ext';
    protected $fillable = [
        'upn_no',
        'name',
        'nationality',
        'dob',
        'mobile_no',
        'postal_address',
        'email',
        'temp_password',
        'reset_token',
        'temp_password_expiry',
        'acted_by',
        'password_status',
        'status',
        'online_status',
        'login_time',
        'logout_time',
        'password',
        'profile',
        'disability',
        'documentName',
        'disability_description',
        'idnumber',
        'home_county',
        'gender',
        'ethnicity'
    ];

     protected $casts = [
        'dob' => 'date',
        
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];
}
