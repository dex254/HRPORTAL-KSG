<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newcurriculum extends Model
{
    use HasFactory;
    protected $table = 'newcurriculum'; 

    // Define which attributes are mass assignable
    protected $fillable = [
        'document_name', 
        'document_name1', 
        'document_name2', 
        'program_name',
        'code',
        'staff_no',
        'staffemail',
        'adminemail',
        
        'campus',
        'status',
        'date',
        'remarks',
        'responsibility',
        'duration',
        'LecturerName',

    ];
}
