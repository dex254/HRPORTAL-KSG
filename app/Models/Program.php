<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    // The name of the table associated with the model
    protected $table = 'programs';


    // The attributes that are mass assignable
    protected $fillable = [
        'proname',   // Program Name
        'code',      // Program Code
        'prodate',   // Date Created
        'idnumber',  // Created By (ID number)
           // Campus Name
        'status',    // Status (Nullable)
    ];

    // If you want to disable the timestamps (if the table doesn't use created_at/updated_at)
    // public $timestamps = false;
    
    // Optionally, you can cast attributes to specific data types
    protected $casts = [
        'prodate' => 'date', // Ensures prodate is treated as a date type
    ];
}
