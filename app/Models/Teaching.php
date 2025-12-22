<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    use HasFactory;

    protected $table = 'teachings';

    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'teaching_areas',
        'employer',
        'job_title',
        'country',
        'stdate',
        'enddate',
        'location',
        'duties',
        'achievements',
        'teaching_path',
    ];
}
