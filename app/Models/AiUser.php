<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AiUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'unique_id'
    ];

    public function messages()
    {
        return $this->hasMany(AiMessage::class);
    }
}
