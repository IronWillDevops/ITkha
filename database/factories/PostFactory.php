<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $dt = $this->faker->dateTimeBetween('2025-01-01', now());
        return [
            'main_image' => $this->faker->imageUrl(800, 600, 'nature', true),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),

            
            'status' => $this->faker->randomElement([
                PostStatus::DRAFT,
                PostStatus::PUBLISHED,
                PostStatus::ARCHIVED,
            ]),
            'category_id' => 1,
            'user_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ];
    }
}
