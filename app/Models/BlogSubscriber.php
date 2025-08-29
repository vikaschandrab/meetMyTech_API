<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogSubscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_subscribed',
        'subscribed_at',
        'unsubscribed_at',
        'unsubscribe_token',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_subscribed' => 'boolean',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Generate a unique unsubscribe token
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscriber) {
            if (empty($subscriber->unsubscribe_token)) {
                $subscriber->unsubscribe_token = Str::random(64);
            }
            if (empty($subscriber->subscribed_at) && $subscriber->is_subscribed) {
                $subscriber->subscribed_at = now();
            }
        });
    }

    /**
     * Scope for subscribed users only
     */
    public function scopeSubscribed($query)
    {
        return $query->where('is_subscribed', true);
    }

    /**
     * Subscribe user
     */
    public function subscribe()
    {
        $this->update([
            'is_subscribed' => true,
            'subscribed_at' => now(),
            'unsubscribed_at' => null,
        ]);
    }

    /**
     * Unsubscribe user
     */
    public function unsubscribe()
    {
        $this->update([
            'is_subscribed' => false,
            'unsubscribed_at' => now(),
        ]);
    }

    /**
     * Check if email is already subscribed
     */
    public static function isSubscribed($email)
    {
        return static::where('email', $email)
                    ->where('is_subscribed', true)
                    ->exists();
    }

    /**
     * Get subscriber by email
     */
    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }

    /**
     * Get subscriber by unsubscribe token
     */
    public static function findByToken($token)
    {
        return static::where('unsubscribe_token', $token)->first();
    }
}
