<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coordinatoreval extends Model
{
    use HasFactory;
   // Specify the key type as string (UUID)

    // The table associated with the model
    protected $table = 'coordinatorevals';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'codeuuid','campus', 'pcode', 'codeuuid', 'codeemail', 'pemail', 'date', 
        'like', 'suggest', 'Organization', 'Briefing', 'Leveling', 
        'Communication', 'Management', 'Monitoring', 'Program', 
        'Action', 'General', 'status'
    ];
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