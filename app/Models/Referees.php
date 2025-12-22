<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referees extends Model
{
    use HasFactory;

    protected $table = 'referees';

    protected $fillable = [
         'upn_no',
        'email',
        'phone',
        'name',
        'employer',
        'job_title',
        'refname',
        'refphone',
        'refemail',
        'Position',
    ];
}
