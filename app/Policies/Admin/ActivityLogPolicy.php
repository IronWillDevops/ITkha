<?php

namespace App\Policies\Admin;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('log.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ActivityLog $log): bool
    {
        return $user->hasPermission('log.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('log.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ActivityLog $log): bool
    {
        return $user->hasPermission('log.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ActivityLog $log): bool
    {
        return $user->hasPermission('log.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ActivityLog $log): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ActivityLog $log): bool
    {
        return false;
    }
}
