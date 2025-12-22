<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIChart extends Model
{
    use HasFactory;
    protected $table = 'ai_charts';

    protected $fillable = ['ip_address', 'question', 'response'];
}

