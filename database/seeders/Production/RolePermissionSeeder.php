<?php

namespace Database\Seeders\Production;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $modules = [
            'post'      => ['view', 'create', 'update', 'delete'],
            'category'  => ['view', 'create', 'update', 'delete'],
            'tag'       => ['view', 'create', 'update', 'delete'],
            'comment'   => ['view', 'create', 'update', 'delete'],
            'user'      => ['view', 'create', 'update', 'delete'],
            'role'      => ['view', 'create', 'update', 'delete'],
            'contact'   => ['view',  'update',],
            'log'       => ['view'],
            'setting'   => ['access', 'view', 'create', 'update', 'delete'],
        ];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'key'    => "$module.$action",
                ], [
                    'header' => $module,
                ]);
            }
        }

        $adminRole  = Role::firstOrCreate(['title' => 'admin']);
        $editorRole = Role::firstOrCreate(['title' => 'editor']);
        $userRole   = Role::firstOrCreate(['title' => 'user']);

        // Admin получает все права
        $adminRole->permissions()->sync(Permission::all());

        // Editor — только контент
        $editorModules = ['post', 'tag', 'category', 'comment'];
        $editorPermissions = Permission::whereIn('header', $editorModules)->get(); // Добавляем permission setting.access
        $settingAccess = Permission::where('key', 'setting.access')->first();
        if ($settingAccess) {
            $editorPermissions->push($settingAccess);
        }

        $editorRole->permissions()->sync($editorPermissions);

        // Первый пользователь — админ
        if ($user = User::first()) {
            $user->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
