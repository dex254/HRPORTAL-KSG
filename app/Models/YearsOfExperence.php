<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearsOfExperence extends Model
{
    use HasFactory;

    protected $table = 'years_of_experence';

    protected $fillable = [
        'upn_no',
        'email',
        'years',
    ];
}
