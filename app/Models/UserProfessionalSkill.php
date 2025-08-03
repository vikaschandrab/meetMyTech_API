<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfessionalSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'communication',
        'team_work',
        'project_management',
        'creativity',
        'team_management',
        'active_participation',
    ];

    /**
     * Relationship: A skill belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
