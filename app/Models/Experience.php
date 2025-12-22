<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'experinces';
    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'employer',
        'job_title',
        'country',
        'stdate',
        'enddate',
        'location',
        'expartise',
        'duties',
         'years_of_experience',
        
    ];
}
