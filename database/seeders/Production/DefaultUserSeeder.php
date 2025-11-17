<?php

namespace Database\Seeders\Production;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // умова унікальності
            [
                'name' => 'Administrator',
                'login' => 'admin',
                'password' => Hash::make('password'),
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'status' => UserStatus::ACTIVE->value,
            ]
        );
    }
}
