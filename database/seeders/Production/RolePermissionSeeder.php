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
            'contact'   => ['view', 'update'],
            'log'       => ['view'],
            'setting'   => ['access', 'view', 'create', 'update', 'delete'],
            'backup'    => ['view', 'create', 'download', 'restore', 'delete'],
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

        $roles = [
            'admin' => 'Administrator with full access to all system modules, settings, and user management.',
            'editor' => 'Editor responsible for managing and moderating site content such as posts, categories, tags, and comments.',
            'user' => 'Regular user with basic access to the system without administrative privileges.',
        ];

        $roleModels = [];

        foreach ($roles as $title => $description) {
            $roleModels[$title] = Role::updateOrCreate(
                ['title' => $title],
                ['description' => $description]
            );
        }

        $adminRole  = $roleModels['admin'];
        $editorRole = $roleModels['editor'];
        $userRole   = $roleModels['user'];

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
