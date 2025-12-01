<?php

namespace App\Policies\Admin;

use App\Models\User;
use App\Models\Contact;

class ContactPolicy
{
    /**
     * Determine whether the Contact can view any models.
     */
    public function viewAny(User $user): bool
    {
         return $user->hasPermission('contact.view');
    }

    /**
     * Determine whether the Contact can view the model.
     */
    public function view(User $user, Contact $model): bool
    {
         return $user->hasPermission('contact.view');
    }

    /**
     * Determine whether the Contact can create models.
     */
    public function create(User $user): bool
    {
         return $user->hasPermission('contact.create');
    }

    /**
     * Determine whether the Contact can update the model.
     */
    public function update(User $user, Contact $model): bool
    {
         return $user->hasPermission('contact.update');
    }

    /**
     * Determine whether the Contact can delete the model.
     */
    public function delete(User $user, Contact $model): bool
    {
         return $user->hasPermission('contact.delete');
    }

    /**
     * Determine whether the Contact can restore the model.
     */
    public function restore(User $user, Contact $model): bool
    {
        return false;
    }

    /**
     * Determine whether the Contact can permanently delete the model.
     */
    public function forceDelete(Contact $contact, Contact $model): bool
    {
        return false;
    }
}
