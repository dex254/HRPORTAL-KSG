<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JOBExt extends Model
{
    use HasFactory;
     protected $table = 'jobexts'; 

    protected $fillable = [
        'area',
       
        'Specialization',
        'level',
        'AE',
        'IP',
        'Var',
        'Ref_NO',
        'datefrom',
        'deadline',
        'status',
        'Proposed_No_of_Positions'
    ];
}
