<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutSet extends Model
{
    use HasFactory;

    protected $fillable = [
        'workout_exercise_id',
        'set_number',
        'reps',
        'weight',
        'weight_unit',
        'rest_seconds',
        'is_completed',
        'notes',
    ];

    protected $casts = [
        'weight' => 'decimal:2',
        'is_completed' => 'boolean',
    ];

    /**
     * Get the exercise that owns the set.
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(WorkoutExercise::class, 'workout_exercise_id');
    }

    /**
     * Get formatted weight
     */
    public function getFormattedWeightAttribute(): string
    {
        if (!$this->weight) return '-';
        return $this->weight . ' ' . $this->weight_unit;
    }

    /**
     * Get formatted rest time
     */
    public function getFormattedRestAttribute(): string
    {
        if (!$this->rest_seconds) return '-';
        $minutes = floor($this->rest_seconds / 60);
        $seconds = $this->rest_seconds % 60;
        if ($minutes > 0) {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
        return $seconds . 's';
    }
}
