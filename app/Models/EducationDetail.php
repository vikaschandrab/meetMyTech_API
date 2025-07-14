<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'degree',
        'from_date',
        'to_date',
        'percentage_or_cgpa',
        'university',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
