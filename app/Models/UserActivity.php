<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'professional_skills',
    ];

    protected $casts = [
        'professional_skills' => 'array', // JSON to array casting
    ];

    // Relationship: each activity belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

