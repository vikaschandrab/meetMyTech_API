<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seo_description',
        'seo_keywords',
        'logo_jpeg',
        'logo_png',
        'logo_72_72_png',
        'logo_114_114_png',
        'logo_69_64_png',
        'logo_16_14_png',
        'logo_16_14_ico',
        'tawk_js',
    ];

    /**
     * Get the user that owns the site setting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
