<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'facebook_profile',
        'instagram_profile',
        'linkedin_profile',
        'whatsapp_number',
        'about',
        'technologies',
        'resume_filename',
    ];

    /**
     * Relationship: UserDetail belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
