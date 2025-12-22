<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Participants extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default plural form
    protected $table = 'participants';

    // Define the mass-assignable attributes
    protected $fillable = [
        'name',
        'email',
        'phone',
        'programname',
        'campus',
        'code',
        'date',
        'coodename',
        'idnumber',
        'institution',
        'coodemail',
        'Last_Mofified_by',
        'status',
        'assistantname',
        'assistantemail',
        'assistantid'
        // Add this if you're storing the completion date
    ];

    // Use UUID as the primary key
    protected $keyType = 'string'; // Set the key type to string (UUID)
    public $incrementing = false;  // Disable auto-incrementing for the primary key

    // Automatically generate a UUID for the primary key on creation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();  // Generate UUID for the participant ID
            }
        });
    }
}
