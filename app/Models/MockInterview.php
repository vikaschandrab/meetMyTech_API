<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MockInterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'date',
        'time',
        'experience',
        'technology',
        'notes',
        'status',
        'meeting_link',
        'meeting_id',
        'admin_notes',
        'created_by',
        'duration',
    ];

    protected $casts = [
        'date' => 'date', // <-- ensures $interview->date is Carbon instance
        'time' => 'datetime:H:i', // optional, if you want Carbon instance
    ];
}
