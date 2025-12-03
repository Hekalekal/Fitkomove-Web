<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\Reminder;
use App\Models\Schedule;
use App\Models\WorkoutSession;
use App\Policies\ActivityPolicy;
use App\Policies\ReminderPolicy;
use App\Policies\SchedulePolicy;
use App\Policies\WorkoutSessionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(Schedule::class, SchedulePolicy::class);
        Gate::policy(Reminder::class, ReminderPolicy::class);
        Gate::policy(WorkoutSession::class, WorkoutSessionPolicy::class);
    }
}
