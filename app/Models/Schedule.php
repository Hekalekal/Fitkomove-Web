<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'activity_type',
        'scheduled_date',
        'scheduled_time',
        'duration_minutes',
        'notes',
        'status',
        'is_recurring',
        'recurring_days',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'scheduled_time' => 'datetime:H:i',
        'is_recurring' => 'boolean',
    ];

    /**
     * Get the user that owns the schedule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if schedule is for today
     */
    public function getIsTodayAttribute(): bool
    {
        return $this->scheduled_date->isToday();
    }

    /**
     * Check if schedule is upcoming
     */
    public function getIsUpcomingAttribute(): bool
    {
        return $this->scheduled_date->isFuture() || $this->scheduled_date->isToday();
    }

    /**
     * Get formatted time
     */
    public function getFormattedTimeAttribute(): string
    {
        return date('H:i', strtotime($this->scheduled_time));
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'completed' => 'bg-success',
            'skipped' => 'bg-secondary',
            default => 'bg-warning',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'completed' => 'Selesai',
            'skipped' => 'Dilewati',
            default => 'Pending',
        };
    }

    /**
     * Scope for today's schedules
     */
    public function scopeToday($query)
    {
        return $query->whereDate('scheduled_date', today());
    }

    /**
     * Scope for upcoming schedules
     */
    public function scopeUpcoming($query)
    {
        return $query->where('scheduled_date', '>=', today())
                     ->orderBy('scheduled_date')
                     ->orderBy('scheduled_time');
    }

    /**
     * Scope for pending schedules
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
