<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    // Define the table name (optional, if it's named differently from the pluralized model name)
    protected $table = 'curriculum';
    protected $primaryKey = 'id';

    // Define the fillable attributes to allow mass assignment
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
