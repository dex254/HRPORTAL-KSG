<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory;

    // Define the table name if it's different from the model name
    protected $table = 'specials';

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
    public $timestamps = false;
}