<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            Production\DefaultUserSeeder::class,
            Production\DefaultCategorySeeder::class,
            Production\RolePermissionSeeder::class,
            Production\SettingsSeeder::class,
        ]);

        if (!app()->environment('production')) {
            $this->call([
                Development\PostSeeder::class,
                Development\ContactSeeder::class,
            ]);
        }
    }
}
