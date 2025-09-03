<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'age',
        'school',
        'future_expertise',
        'education',
        'university',
        'occupation',
        'interests',
        'contact_preferences',
        'ip_address',
        'user_agent',
        'browser',
        'browser_version',
        'device',
        'platform',
        'platform_version',
        'is_mobile',
        'is_tablet',
        'is_desktop',
        'language',
        'screen_resolution',
        'color_depth',
        'device_memory',
        'time_zone',
        'touch_support',
        'connection_type',
        'password',
        'email_verified_at',
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
        'password' => 'hashed',
        'interests' => 'json',
        'contact_preferences' => 'json',
        'is_mobile' => 'boolean',
        'is_tablet' => 'boolean',
        'is_desktop' => 'boolean',
        'touch_support' => 'boolean',
    ];

    public function getInterestsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getContactPreferencesAttribute($value)
    {
        return json_decode($value, true);
    }
}
