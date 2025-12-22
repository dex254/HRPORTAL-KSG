<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AiMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ai_user_id',
        'question',
        'response',
         'role',
         'context_type'
    ];

    public function user()
    {
        return $this->belongsTo(AiUser::class);
    }
}
