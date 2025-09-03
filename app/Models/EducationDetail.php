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

    protected $dates = [
        'from_date',
        'to_date',
    ];

    /**
     * Get the duration of this education in years (rounded up)
     */
    public function getDurationInYearsAttribute()
    {
        $fromDate = \Carbon\Carbon::parse($this->from_date);
        $toDate = $this->to_date ? \Carbon\Carbon::parse($this->to_date) : \Carbon\Carbon::now();

        // Calculate years with decimal precision and round up to the greatest number
        $yearsDiff = $fromDate->diffInDays($toDate) / 365.25;
        return ceil($yearsDiff);
    }

    /**
     * Get the duration of this education in years with decimal precision
     */
    public function getExactDurationInYearsAttribute()
    {
        $fromDate = \Carbon\Carbon::parse($this->from_date);
        $toDate = $this->to_date ? \Carbon\Carbon::parse($this->to_date) : \Carbon\Carbon::now();

        // Calculate years with decimal precision (2 decimal places)
        $yearsDiff = $fromDate->diffInDays($toDate) / 365.25;
        return round($yearsDiff, 2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
