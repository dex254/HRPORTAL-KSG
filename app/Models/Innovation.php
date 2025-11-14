<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Innovation extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'securitykey',
        'title',
        'content',
        'innovation_number',
        'innovation_type',
        'attachment',
        'link',
        'evidence',
        'report_pdf',
    ];

    // Relationship to the Invent model
    public function invent()
    {
        return $this->belongsTo(Invent::class, 'invent_id');
    }
}
