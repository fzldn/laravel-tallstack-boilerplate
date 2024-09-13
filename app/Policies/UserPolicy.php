<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::USERS_VIEWANY->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::USERS_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::USERS_CREATE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::USERS_UPDATE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if (!$model->is($user)) {
            return false;
        }

        return $user->can(PermissionsEnum::USERS_DELETE->value);
    }

    /**
     * Determine whether the user can delete models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can(PermissionsEnum::USERS_DELETEANY->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return true;
    }
}
