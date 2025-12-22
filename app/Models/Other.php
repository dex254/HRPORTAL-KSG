<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    use HasFactory;
    protected $table = 'others';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'upn_no',
        'Client',
        'Sector',
        'completed',
        'compedate',
        'Amount',
        'type',
        'document_name' // Consultancy or Research
    ];
}
