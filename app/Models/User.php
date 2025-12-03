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
        'current_streak',
        'longest_streak',
        'last_activity_date',
        'streak_freezes',
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
            'last_activity_date' => 'date',
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
     * Get user's workout sessions
     */
    public function workoutSessions(): HasMany
    {
        return $this->hasMany(WorkoutSession::class);
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

    /**
     * Check if user has activity today
     */
    public function hasActivityToday(): bool
    {
        return $this->last_activity_date && $this->last_activity_date->isToday();
    }

    /**
     * Update user's workout streak
     */
    public function updateStreak(): void
    {
        $today = now()->startOfDay();
        $lastActivityDate = $this->last_activity_date;

        // Already worked out today, no update needed
        if ($lastActivityDate && $lastActivityDate->isSameDay($today)) {
            return;
        }

        // Check if last activity was yesterday (consecutive day)
        if ($lastActivityDate && $lastActivityDate->isSameDay($today->copy()->subDay())) {
            $this->current_streak++;
        } else {
            // Streak broken - reset to 1
            $this->current_streak = 1;
        }

        // Update longest streak if current is higher
        if ($this->current_streak > $this->longest_streak) {
            $this->longest_streak = $this->current_streak;
        }

        $this->last_activity_date = $today;
        $this->save();
    }
}