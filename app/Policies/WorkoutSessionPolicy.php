<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkoutSession;

class WorkoutSessionPolicy
{
    /**
     * Determine whether the user can view the workout session.
     */
    public function view(User $user, WorkoutSession $workout): bool
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can update the workout session.
     */
    public function update(User $user, WorkoutSession $workout): bool
    {
        return $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can delete the workout session.
     */
    public function delete(User $user, WorkoutSession $workout): bool
    {
        return $user->id === $workout->user_id;
    }
}
