<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'gender',
        'job',
        'birth_date',
        'profile_photo',
        'height',
        'weight',
        'target_weight',
        'goal',
        'intensity_level',
        'onboarding_completed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birth_date' => 'date',
            'height' => 'float',
            'weight' => 'float',
            'target_weight' => 'float',
            'onboarding_completed' => 'boolean',
        ];
    }

    /**
     * Get user's activities
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Get user's schedules
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get user's reminders
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Calculate BMI
     */
    public function getBmiAttribute(): ?float
    {
        if (!$this->height || !$this->weight) {
            return null;
        }
        // BMI = weight (kg) / height (m)^2
        $heightInMeters = $this->height / 100;
        return round($this->weight / ($heightInMeters * $heightInMeters), 1);
    }

    /**
     * Get BMI category
     */
    public function getBmiCategoryAttribute(): ?string
    {
        $bmi = $this->bmi;
        if (!$bmi) return null;

        if ($bmi < 18.5) return 'Underweight';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Overweight';
        return 'Obese';
    }

    /**
     * Get BMI category color
     */
    public function getBmiColorAttribute(): string
    {
        $category = $this->bmi_category;
        return match($category) {
            'Underweight' => '#3b82f6',
            'Normal' => '#22c55e',
            'Overweight' => '#f59e0b',
            'Obese' => '#ef4444',
            default => '#6b7280',
        };
    }

    /**
     * Get age from birth_date
     */
    public function getCalculatedAgeAttribute(): ?int
    {
        if (!$this->birth_date) {
            return $this->age;
        }
        return $this->birth_date->age;
    }

    /**
     * Get profile photo URL
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }
        return null;
    }

    /**
     * Get total calories burned this week
     */
    public function getWeeklyCaloriesAttribute(): float
    {
        return $this->activities()
            ->whereBetween('activity_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('calories_burned') ?? 0;
    }

    /**
     * Get total activities this week
     */
    public function getWeeklyActivitiesCountAttribute(): int
    {
        return $this->activities()
            ->whereBetween('activity_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }

    /**
     * Get total duration this week (in minutes)
     */
    public function getWeeklyDurationAttribute(): int
    {
        return $this->activities()
            ->whereBetween('activity_date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('duration_minutes') ?? 0;
    }
}