<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_name',
        'message',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
