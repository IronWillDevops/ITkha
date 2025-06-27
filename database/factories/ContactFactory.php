<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
            'email' => $this->faker->email(),
            'message' => $this->faker->sentence(),
            
        ];
    }
}
