<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class HR extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    

    protected $table = 'hr'; // Explicitly define the table name

    protected $fillable = [
       

        's_no',
        'payroll_num',
        'upn_no',
        'name',
        'designation',
        'job_group',
        'campus',
        'job_designation',
        'job_code',
        'idnumber',
        'ethnicity',
        'dob',
        'disability',
        'gender',
        'first_date_of_appointment',
        'current_date_of_appointment',
        'home_county',
        'email',
        'password',
        'phone',
        
        'academic_qualifications',
        'ongoing_long_courses',
        'career_guideline_requirements',
        'status',
        'identified_gaps',
      
        'disability_description',
        'application_status',




    ];
    protected $hidden = [
        'upn_no', 
        'password',
        'remember_token',
    ];
    
}
