<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'licence';

    // Define fillable fields
    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'job_group',
        'has_license',
        'license_name',
        'license_date',
        'document_name', // Name of the uploaded document
    ];

    // Enable timestamps (created_at and updated_at)
    
}