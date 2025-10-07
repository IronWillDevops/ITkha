<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            ['Header' => 'Posts', 'title' => 'posts_create', 'description' => 'Create posts'],
            ['Header' => 'Posts', 'title' => 'posts_edit', 'description' => 'Edit posts'],
            ['Header' => 'Posts', 'title' => 'posts_delete', 'description' => 'Delete posts'],
            ['Header' => 'Posts', 'title' => 'posts_show', 'description' => 'Show posts'],

            ['Header' => 'Categories', 'title' => 'categories_create', 'description' => 'Create categories'],
            ['Header' => 'Categories', 'title' => 'categories_edit', 'description' => 'Edit categories'],
            ['Header' => 'Categories', 'title' => 'categories_delete', 'description' => 'Delete categories'],
            ['Header' => 'Categories', 'title' => 'categories_show', 'description' => 'Show categories'],

            ['Header' => 'Tags', 'title' => 'tags_create', 'description' => 'Create tags'],
            ['Header' => 'Tags', 'title' => 'tags_edit', 'description' => 'Edit tags'],
            ['Header' => 'Tags', 'title' => 'tags_delete', 'description' => 'Delete tags'],
            ['Header' => 'Tags', 'title' => 'tags_show', 'description' => 'Show tags'],

            ['Header' => 'Comments', 'title' => 'comments_create', 'description' => 'Create comments'],
            ['Header' => 'Comments', 'title' => 'comments_edit', 'description' => 'Edit comments'],
            ['Header' => 'Comments', 'title' => 'comments_delete', 'description' => 'Delete comments'],
            ['Header' => 'Comments', 'title' => 'comments_show', 'description' => 'Show comments'],

            ['Header' => 'Users', 'title' => 'users_create', 'description' => 'Create users'],
            ['Header' => 'Users', 'title' => 'users_edit', 'description' => 'Edit users'],
            ['Header' => 'Users', 'title' => 'users_delete', 'description' => 'Delete users'],
            ['Header' => 'Users', 'title' => 'users_show', 'description' => 'Show users'],

            ['Header' => 'Roles', 'title' => 'roles_edit', 'description' => 'Edit roles'],
            ['Header' => 'Roles', 'title' => 'roles_create', 'description' => 'Create roles'],
            ['Header' => 'Roles', 'title' => 'roles_delete', 'description' => 'Delete roles'],
            ['Header' => 'Roles', 'title' => 'roles_show', 'description' => 'Show roles'],

            ['Header' => 'Contacts', 'title' => 'contacts_edit', 'description' => 'Edit contact'],
            ['Header' => 'Contacts', 'title' => 'contacts_create', 'description' => 'Create contact'],
            ['Header' => 'Contacts', 'title' => 'contacts_delete', 'description' => 'Delete contact'],
            ['Header' => 'Contacts', 'title' => 'contacts_show', 'description' => 'Show contact'],

            ['Header' => 'Logs', 'title' => 'logs_show', 'description' => 'Show logs'],

            ['Header' => 'Settings', 'title' => 'admin_access', 'description' => 'Access to the admin panel'],
            ['Header' => 'Settings', 'title' => 'server_info', 'description' => 'Server information view']

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['title' => $permission['title']], $permission);
        }

        $adminRole = Role::firstOrCreate(['title' => 'admin']);
        $editorRole = Role::firstOrCreate(['title' => 'editor']);
        $userRole = Role::firstOrCreate(['title' => 'user']);

        $adminRole->permissions()->sync(Permission::all());

        $editorPermissions = Permission::whereIn('Header', ['Posts', 'Tags', 'Categories'])->get();
        // Додаємо admin_access окремо
        $adminAccess = Permission::where('title', 'admin_access')->first();

        if ($adminAccess) {
            $editorPermissions->push($adminAccess); // додаємо до колекції
        }
        $editorRole->permissions()->sync($editorPermissions);

        // Призначення ролі admin першому користувачу в базі
        $firstUser = User::first();
        if ($firstUser) {

            $firstUser->roles()->syncWithoutDetaching([$adminRole->id]);
        }
    }
}
