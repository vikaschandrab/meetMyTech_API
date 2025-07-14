<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'organization',
        'from_date',
        'to_date',
        'roles_and_responsibilities',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
