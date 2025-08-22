<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'subject' => $this->faker->sentence(4),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->paragraph(3),
            'is_read' => $this->faker->boolean(30), // 30% сообщений как прочитанные
            'created_at' => $this->faker->dateTimeBetween('2025-01-01', now()),
            'updated_at' => now(),
        ];
    }
}
