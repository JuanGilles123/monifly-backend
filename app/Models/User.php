<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Basic profile
        'country',
        'currency_preferred',
        // Social auth fields
        'provider',
        'provider_id',
        'google_id', // Specific Google ID field
        'avatar',
        'avatar_url', // URL for avatar images
        // Profile fields
        'phone',
        'birth_date',
        'gender',
        // MoniFly specific
        'currency',
        'timezone',
        'language',
        'monthly_income',
        'financial_goals',
        // Preferences
        'notifications_enabled',
        'email_notifications',
        'push_notifications',
        'profile_completed',
        'last_active_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_id', // Hide social provider ID for security
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'monthly_income' => 'decimal:2',
            'financial_goals' => 'array',
            'notifications_enabled' => 'boolean',
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'profile_completed' => 'boolean',
            'last_active_at' => 'datetime',
        ];
    }

    /**
     * Get the user's financial goals.
     */
    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }
}
