<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    use HasFactory;
    protected $table = 'password';

    protected $fillable = [
        'email','status', 'created_at'
    ];

    public $timestamps = false;
}
