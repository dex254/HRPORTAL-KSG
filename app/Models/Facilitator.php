<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilitator extends Model
{
    use HasFactory;
    protected $table = 'facilitators'; // Corresponding table name

    protected $fillable = [
        'Topic_description',
        'Topic_code',
        'No_of_hours',
        'LecturerName',
        'Staff_No',
        'Session_code',
        'TimeTable_No',
        'Co_facilitator_staff_no',
        'coodemail',
        'proname',
        'procode',
        'pemail',
        'campus',
        'date',
        'like',
        'suggest',
        'punctuality',
        'presentation_flow',
        'handling_questions',
        'active_participation_of_learners',
        'use_of_visual_aids',
        'relevance_of_subject_to_workplace',
        'use_of_relevant_examples',
        'knowledge_of_subject',
        'treats_participants_with_dignity_and_respect',
        'variety_and_appropriateness_of_training_methods',
        'status',
    ];
}