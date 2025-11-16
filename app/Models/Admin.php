<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

      use HasFactory, Notifiable;

     protected $table = 'admin';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'login_time',
        'logout_time',
        'last_login_ip',
        'failed_attempts',
        'is_online',
        'profile',
        'activity',
        'digitalsignature',
        'otp',
        'temp_password',
        'temp_password_expiry',
        'reset_token',
        'otp_expires_at',
        'role',
        'dash',
        'approvals',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'temp_password',
        'reset_token',
        'remember_token',
    ];

    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
        'temp_password_expiry' => 'datetime',
        'is_online' => 'boolean',
    ];
}