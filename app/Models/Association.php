<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $table = 'associations';
    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'job_group',
        'condition',
        'association_name',
        'status',
        'date',
        'document_name',
    ];
}
