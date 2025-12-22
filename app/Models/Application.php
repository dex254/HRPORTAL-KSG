<?php

namespace App\Models;

use App\Models\HR;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'Ref_No',
        'upn_no',
        'email',
        'phone',
        'idnumber',
        'name',
        'designation',
        'job_s_no',
        'status',
        'datetime',
        'cv',
        'cover_letter',
        'my_bio',
        'Expected',
        'job_group',
        'MEMO',
        'rejection_reason',
        'intervew',
        'venue'
    ];

    // Relationship: Each application belongs to a job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_s_no', 's_no');
    }
    public function hr()
    {
        return $this->hasOne(HR::class, 'upn_no', 'upn_no');
    }
    public function hrpu()
    {
        return $this->hasOne(HRPU::class, 'upn_no', 'upn_no');
    }
}
