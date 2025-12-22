<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EXTJOB extends Model
{
    use HasFactory;

    protected $table = 'extjobs'; // Ensure table name matches the migration

    protected $fillable = [
        'Designation',
        'Job_Group',
        'level',
        'Proposed_No_of_Positions',
        'AE',
        'IP',
        'Var',
        'Ref_NO',
        'datefrom',
        'deadline',
        'status',
        'qualifications',
    ];
}
