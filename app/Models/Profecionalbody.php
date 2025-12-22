<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profecionalbody extends Model
{
    use HasFactory;
    protected $table = 'profecionalbodies';

    // Define fillable columns
    protected $fillable = [
        'upn_no',
        'email',
        'phone',
        'name',
        'job_group',
        'is_member',
        'professional_body',
        'law',
        'status',
        'date',
        'document_name',
    ];
}
