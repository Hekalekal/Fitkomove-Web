<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'description',
        'activity_date',
        'start_time',
        'end_time',
        'duration_minutes',
        'distance_km',
        'calories_burned',
        'pace',
        'heart_rate_avg',
        'notes',
    ];

    protected $casts = [
        'activity_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'distance_km' => 'float',
        'calories_burned' => 'float',
    ];

    /**
     * Get the user that owns the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get activity type label
     */
    public function getTypeLabelAttribute(): string
    {
        $types = [
            'running' => 'Lari',
            'cycling' => 'Bersepeda',
            'workout' => 'Workout',
            'swimming' => 'Berenang',
            'walking' => 'Jalan Kaki',
            'yoga' => 'Yoga',
            'hiit' => 'HIIT',
            'strength' => 'Strength Training',
            'other' => 'Lainnya',
        ];

        return $types[$this->type] ?? $this->type;
    }

    /**
     * Get activity type icon
     */
    public function getTypeIconAttribute(): string
    {
        $icons = [
            'running' => 'bi-person-walking',
            'cycling' => 'bi-bicycle',
            'workout' => 'bi-lightning',
            'swimming' => 'bi-water',
            'walking' => 'bi-person',
            'yoga' => 'bi-peace',
            'hiit' => 'bi-fire',
            'strength' => 'bi-trophy',
            'other' => 'bi-activity',
        ];

        return $icons[$this->type] ?? 'bi-activity';
    }

    /**
     * Calculate estimated calories if not provided
     */
    public static function estimateCalories(string $type, int $durationMinutes, float $weightKg = 70): float
    {
        // MET values for different activities
        $metValues = [
            'running' => 9.8,
            'cycling' => 7.5,
            'workout' => 6.0,
            'swimming' => 8.0,
            'walking' => 3.5,
            'yoga' => 2.5,
            'hiit' => 10.0,
            'strength' => 5.0,
            'other' => 4.0,
        ];

        $met = $metValues[$type] ?? 4.0;
        // Calories = MET × weight (kg) × duration (hours)
        return round($met * $weightKg * ($durationMinutes / 60), 1);
    }
}
