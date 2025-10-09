<?php

namespace App\Policies\Admin;

use App\Models\Setting;

class SettingPolicy
{
    /**
     * Create a new policy instance.
     */
   /**
     * Determine whether the Setting can view any models.
     */
    public function viewAny(Setting $setting): bool
    {
         return $setting->hasPermission('settings_show');
    }

    /**
     * Determine whether the Setting can view the model.
     */
    public function view(Setting $setting, Setting $model): bool
    {
         return $setting->hasPermission('settings_show');
    }

    /**
     * Determine whether the Setting can create models.
     */
    public function create(Setting $setting): bool
    {
         return $setting->hasPermission('settings_create');
    }

    /**
     * Determine whether the Setting can update the model.
     */
    public function update(Setting $setting, Setting $model): bool
    {
         return $setting->hasPermission('settings_edit');
    }

    /**
     * Determine whether the Setting can delete the model.
     */
    public function delete(Setting $setting, Setting $model): bool
    {
         return $setting->hasPermission('settings_delete');
    }

    /**
     * Determine whether the Setting can restore the model.
     */
    public function restore(Setting $setting, Setting $model): bool
    {
        return false;
    }

    /**
     * Determine whether the Setting can permanently delete the model.
     */
    public function forceDelete(Setting $setting, Setting $model): bool
    {
        return false;
    }
}
