<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'admin';
    protected $primaryKey = 'id';

    /**
     * UUID settings
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'id',
        'name',
        'idnumber',
        'phone',
        'email',
        'role',
        'password',
        'temp_password',
        'temp_password_expiry',
        'reset_token',
        'otp',
        'otp_expires_at',
        'image',
        'campus',
        'is_online',
        'login_time',
        'logout_time',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'temp_password',
        'reset_token',
        'remember_token',
        'otp',
    ];

    /**
     * Cast attributes
     */
    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
        'temp_password_expiry' => 'datetime',
        'otp_expires_at' => 'datetime',
        'is_online' => 'boolean',
    ];

    /**
     * Automatically generate UUID on create
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            if (!$admin->id) {
                $admin->id = (string) Str::uuid();
            }
        });
    }
}
