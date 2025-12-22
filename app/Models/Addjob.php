<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addjob extends Model
{
    use HasFactory;
    protected $table = 'addjob';
    protected $fillable = [
        'file_path',  // Allow mass assignment for 'file_path'
    ];

    /**
     * Get the full public URL of the stored file.
     *
     * @return string|null
     */
    public function getFileUrl()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }
}
