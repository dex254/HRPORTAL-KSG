<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $table = 'academics'; // Ensure it matches your database table name

    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'institution',
        'course',
        'level',
        'stdate',
        'enddate',
        'grade',
        'document_name',
        'Education_type',
         // Storing document filename
    ];
}
