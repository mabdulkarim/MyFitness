<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ExercisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Exercise $exercise
     * @return Response|bool
     */
    public function update(User $user, Exercise $exercise): Response|bool
    {
        return $user->can(Permissions::UPDATE_EXERCISE->value) || $user->id === $exercise->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Exercise $exercise
     * @return Response|bool
     */
    public function delete(User $user, Exercise $exercise): Response|bool
    {
        return $user->can(Permissions::DELETE_EXERCISE->value) || $user->id === $exercise->user_id;
    }
}
