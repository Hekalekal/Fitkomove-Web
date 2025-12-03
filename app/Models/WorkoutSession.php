<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'notes',
        'started_at',
        'ended_at',
        'total_duration_seconds',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Get the user that owns the workout session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the exercises for the workout session.
     */
    public function exercises(): HasMany
    {
        return $this->hasMany(WorkoutExercise::class)->orderBy('order');
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute(): string
    {
        $seconds = abs($this->total_duration_seconds ?? 0);
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $secs = $seconds % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $secs);
        }
        return sprintf('%d:%02d', $minutes, $secs);
    }

    /**
     * Get total sets count
     */
    public function getTotalSetsAttribute(): int
    {
        return $this->exercises->sum(fn($e) => $e->sets->count());
    }

    /**
     * Get completed sets count
     */
    public function getCompletedSetsAttribute(): int
    {
        return $this->exercises->sum(fn($e) => $e->sets->where('is_completed', true)->count());
    }

    /**
     * Check if session is active
     */
    public function getIsActiveAttribute(): bool
    {
        return $this->started_at !== null && $this->ended_at === null;
    }
}
