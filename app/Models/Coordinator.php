<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Coordinator extends Model
{
    use HasFactory;

    // Set the table name
    protected $table = 'coordinator';

    // Define the mass-assignable attributes
    protected $fillable = [
        'uuid', // Make sure to include uuid in fillable if it's mass-assigned
        'name',
        'email',
        'phone',
        'programname',
        'campus',
        'code',
        'date',
        'status',
        'assistantname',
        'assistantemail',
        'assistantid'

        
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uuid'; // Set UUID as the primary key

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // UUIDs are not auto-incrementing

    /**
     * The "type" of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string'; // UUID is stored as a string

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date', // Cast the date field to a date type
    ];

    /**
     * Boot function to automatically generate UUID on creation.
     */
    protected static function booted()
    {
        static::creating(function ($coordinator) {
            // Generate and assign a UUID when creating a new coordinator if no UUID exists
            if (!$coordinator->uuid) {
                $coordinator->uuid = (string) Str::uuid(); // Generate UUID using Str::uuid() helper
            }
        });
    }
}
