<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'reminder_time',
        'days',
        'is_active',
        'last_triggered_at',
    ];

    protected $casts = [
        'reminder_time' => 'datetime:H:i',
        'is_active' => 'boolean',
        'last_triggered_at' => 'datetime',
    ];

    /**
     * Get the user that owns the reminder.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get type label
     */
    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'workout' => 'Olahraga',
            'rest' => 'Istirahat',
            'hydration' => 'Minum Air',
            'meal' => 'Makan',
            default => 'Custom',
        };
    }

    /**
     * Get type icon
     */
    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'workout' => 'bi-lightning',
            'rest' => 'bi-moon',
            'hydration' => 'bi-droplet',
            'meal' => 'bi-egg-fried',
            default => 'bi-bell',
        };
    }

    /**
     * Get days array
     */
    public function getDaysArrayAttribute(): array
    {
        return $this->days ? explode(',', $this->days) : [];
    }

    /**
     * Check if reminder is active for today
     */
    public function isActiveToday(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if (empty($this->days)) {
            return true; // Active every day if no specific days set
        }

        $today = strtolower(date('D')); // mon, tue, wed, etc.
        return in_array($today, $this->days_array);
    }

    /**
     * Get formatted time
     */
    public function getFormattedTimeAttribute(): string
    {
        return date('H:i', strtotime($this->reminder_time));
    }

    /**
     * Scope for active reminders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get days display
     */
    public function getDaysDisplayAttribute(): string
    {
        if (empty($this->days)) {
            return 'Setiap hari';
        }

        $dayLabels = [
            'mon' => 'Sen',
            'tue' => 'Sel',
            'wed' => 'Rab',
            'thu' => 'Kam',
            'fri' => 'Jum',
            'sat' => 'Sab',
            'sun' => 'Min',
        ];

        $days = array_map(fn($d) => $dayLabels[$d] ?? $d, $this->days_array);
        return implode(', ', $days);
    }
}
