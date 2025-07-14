<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_name',
        'percentage',
    ];

    /**
     * Relationship: A skill belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
