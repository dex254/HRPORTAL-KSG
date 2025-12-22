<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;  // Add this if you want to log for debugging purposes

class Timetable extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $primaryKey = 'id';
    protected $table = 'timetables';

    // Disable auto-increment if you will manually assign TimeTable_No
    public $incrementing = true;

    // Disable timestamps if not present in the database
    public $timestamps = false;

    // Specify the attributes that can be mass assigned
    protected $fillable = [
        'TimeTable_No',
        'Select',
        'AssignLecturer',
        'Time_table_date',
        'Time_table_day',
        'Session_code',
        'Start_time',
        'End_time',
        'Facilitator_Code',
        'Staff_No',
        'LecturerName',
        'Co_facilitator',
        'Co_facilitator_staff_no',
        'cofacilitator_name',
        'Unit',
        'UnitDescription',
        'Topic_code',
        'Topic_description',
        'Facilitor_Department',
        'CampusCode',
        'No_of_hours',
        'Rates_per_hour',
        'Status',
        'Last_Mofified_by',
        'Last_modified_date',
        'Last_modified_time',
    ];

    /**
     * Generate TimeTable_No before saving a new record
     */
        // Boot method to handle the TimeTable_No generation
        protected static function boot()
    {
        parent::boot();

        static::created(function ($timetable) {
            // Fetch the latest TimeTable_No from timetable1
            $existingTimetable1 = DB::table('timetable1')
                ->latest('id')  // Get the last entry from timetable1
                ->first();

            // Check if the existing timetable exists and generate the new TimeTable_No
            if ($existingTimetable1) {
                $newTimeTableNo = $existingTimetable1->TimeTable_No . '00' . $timetable->id;

                // Update the new record with the generated TimeTable_No
                $timetable->update(['TimeTable_No' => $newTimeTableNo]);
            }
        });
    }
    }
