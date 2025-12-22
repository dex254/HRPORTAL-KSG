<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default plural form
    protected $table = 'topics';

    // Define the mass-assignable attributes
    protected $fillable = [
        'topname',
        'topcode',
        'code',
        'programname',
        'idnumber',
        'topdate',
        'status'
    ];
    
}
