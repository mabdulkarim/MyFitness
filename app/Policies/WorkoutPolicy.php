<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class WorkoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Workout $workout
     * @return Response|bool
     */
    public function update(User $user, Workout $workout): Response|bool
    {
        return $user->can(Permissions::UPDATE_WORKOUT->value) || $user->id === $workout->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Workout $workout
     * @return bool
     */
    public function delete(User $user, Workout $workout): bool
    {
        return $user->can(Permissions::DELETE_WORKOUT->value) || $user->id === $workout->user_id;
    }
}
