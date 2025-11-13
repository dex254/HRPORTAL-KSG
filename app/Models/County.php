<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = 'counties';
    protected $fillable = ['CountyName', 'SubCounty'];
    public $timestamps = false; // disable timestamps if not in table
}
