<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;

    // Specify the table name (if it doesn't follow Laravel's plural naming convention)
    protected $table = 'weekly';

    // Specify the columns that are mass assignable
    protected $fillable = [
        'programName',
        'campus',
        'name',
        'email',
        'code',
        'roomname',
        'stdate',
        'date',
        'res',
        'nonres',
        'Remarks',
        'iduse',
        'Status',
    ];
   

    // Define any relationships if needed (e.g. if Weekly belongs to Program, etc.)
    // public function program()
    // {
    //     return $this->belongsTo(Program::class, 'code', 'code');
    // }
}

