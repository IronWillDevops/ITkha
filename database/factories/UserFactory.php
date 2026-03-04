<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'login' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => null,
            'password' => Hash::make('password'),
            'status' => UserStatus::ACTIVE->value,
            'remember_token' => Str::random(10),
        ];
    }

    public function active(): static
    {
        return $this->state(fn() => [
            'status' => UserStatus::ACTIVE->value,
            'email_verified_at' => now(),
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn() => [
            'status' => UserStatus::INACTIVE->value,
        ]);
    }

    public function unverified(): static
    {
        return $this->state(fn() => [
            'email_verified_at' => null,
        ]);
    }
}
