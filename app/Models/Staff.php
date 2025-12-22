<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;

class Staff extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable,HasUuids;
    use CanResetPassword;

    protected $primaryKey = 'id'; // Use the UUID column as the primary key
    protected $keyType = 'string'; // UUIDs are strings
    public $incrementing = false; // Disable auto-incrementing
   protected $table = 'staff';


    protected $fillable = [
     'name',
    'idnumber',
     'phone',
     'email',
    'department',
    'usertype',
    'campus',
     'password',
     'is_online',
     'timer',
     'image',
      'Status'


     ];

     /**
      * The attributes that should be hidden for arrays.
      *
      * @var array
      */
     protected $hidden = [
         'password', 'remember_token',
     ];
     public function profile()
{
    return $this->hasOne(Profile::class);
}
}
