<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutExercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_session_id',
        'exercise_name',
        'order',
    ];

    /**
     * Get the workout session that owns the exercise.
     */
    public function workoutSession(): BelongsTo
    {
        return $this->belongsTo(WorkoutSession::class);
    }

    /**
     * Get the sets for the exercise.
     */
    public function sets(): HasMany
    {
        return $this->hasMany(WorkoutSet::class)->orderBy('set_number');
    }

    /**
     * Get best set (highest weight with completed status)
     */
    public function getBestSetAttribute()
    {
        return $this->sets->where('is_completed', true)->sortByDesc('weight')->first();
    }

    /**
     * Get total volume (weight x reps for all completed sets)
     */
    public function getTotalVolumeAttribute(): float
    {
        return $this->sets->where('is_completed', true)->sum(fn($s) => ($s->weight ?? 0) * ($s->reps ?? 0));
    }
}
