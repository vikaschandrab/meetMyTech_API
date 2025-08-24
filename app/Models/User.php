<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contactNum',
        'profilePic',
        'js',
        'user_type',
        'slug',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->slug)) {
                $user->slug = $user->generateSlug($user->name);
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('name') && empty($user->slug)) {
                $user->slug = $user->generateSlug($user->name);
            }
        });
    }

    /**
     * Generate unique slug from name
     */
    public function generateSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function WorkExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }

    public function userActivity()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function UserProfessionalSkill()
    {
        return $this->hasMany(UserProfessionalSkill::class);
    }

    public function EducationDetail(){
        return $this->hasMany(EducationDetail::class);
    }

    public function SiteSettings()
    {
        return $this->hasMany(SiteSetting::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
