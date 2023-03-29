<?php

namespace App\Policies;

use App\Enums\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can(Permissions::READ_USER->value);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return $user->can(Permissions::READ_USER->value) || $user->id === $model->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->can(Permissions::UPDATE_USER->value) || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can(Permissions::DELETE_USER->value) || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create the user measurement model
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function createUserMeasurement(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }
}
