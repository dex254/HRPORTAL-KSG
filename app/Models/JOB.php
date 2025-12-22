<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JOB extends Model
{
    use HasFactory;
    protected $table = 'jobs'; 
    protected $primaryKey = 's_no'; // Specify s_no as the primary key
    public $incrementing = true; // Ensure it's auto-incrementing
    protected $keyType = 'int';// Explicitly set the table name
    
    protected $fillable = [
        'Designation',
        'Job_Group',
        'Proposed_No_of_Positions',
        'AE',
        'IP',
        'Var',
        'Ref_NO',
        'datefrom',
        'deadline',
        'status',
        'qualifications', // Added status field
    ];
}
