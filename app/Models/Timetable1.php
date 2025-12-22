<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timetable1 extends Model
{
    use HasFactory;

    // Set the table name (if different from the default)
    protected $table = 'timetable1'; // Adjust this if your table name is different

    // Define the primary key
    protected $primaryKey = 'id'; 

    // Enable auto-incrementing for the primary key
    public $incrementing = true;

    // Define the type of the primary key (UUID in this case)
    protected $keyType = 'string'; 

    // Define the fillable columns for mass assignment
    protected $fillable = [
        'TimeTable_No', // The UUID
        'Select',
        'AssignLecturer',
        'Unit',
        'UnitDescription',
        'CampusCode',
        'Status',
        'LastModifiedBy'
    ];

    // Optionally, you can set default values for some attributes
    protected $attributes = [
        'Select' => true, // Default value for Select
        'AssignLecturer' => 'Not yet', // Default value for Assign Lecturer
        'Status' => 'Incomplete', // Default value for Status
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->TimeTable_No) {
                // Generate TimeTable_No based on the CampusCode and ID
                $campusCodePrefix = [
                    'Embu' => 'EMBTT',
                    'Nairobi' => 'NRBTT',
                    'Mombasa' => 'MSATT',
                    'Baringo' => 'BRG00',
                    'Matuga' => 'MATT00',
                    'eLDi' => 'ELDTT',
                    'Lower Kabete' => 'LKBTT'
                ];

                // Check if the CampusCode exists in the prefix array
                if (isset($campusCodePrefix[$model->CampusCode])) {
                    // Generate the TimeTable_No by combining the campus prefix and ID
                    $model->TimeTable_No = $campusCodePrefix[$model->CampusCode] . $model->id;
                }
            }
        });
    }

    // You can also create a boot method to automatically generate UUID for the primary key
    
}