<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coremandate extends Model
{
    use HasFactory;
    protected $table = 'coremandate';

    // Define fillable fields
    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'job_group',
        'comandate',
        'selected_count',
        'date',
        'status',
    ];

    // If you want to disable timestamps (created_at and updated_at)
    
}
