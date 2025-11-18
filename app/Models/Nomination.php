<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nomination extends Model
{
    //

    use HasFactory;

     protected $table = 'nominations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'country',
        'county',
        'subcounty',
        'nominee_name',
        'work_station',
        'designation',
        'duties',
        'outstanding_behavior',
        'justification',
        'lessons',
        'attachment_path',
        'ip_address',
        'phone',
        'status'
    ];
}
