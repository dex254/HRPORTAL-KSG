<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proffecional extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'proffecional';

    // Disable timestamps (created_at and updated_at columns)
    public $timestamps = false;

    // Define the primary key (if 'no' is the primary key)
    protected $primaryKey = 'no';

    // Disable auto-incrementing for the primary key (if 'no' is not auto-incrementing)
    public $incrementing = false;

    // Define fillable columns
    protected $fillable = [
        'no',   // Primary key
        'name', // Name of the professional body
        'law',  // Regulating law/statute
    ];
}