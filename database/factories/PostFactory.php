<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            $title = $this->faker->sentence;

        $text = urlencode($this->faker->words(2, true));
        return [
            'main_image' => "https://placehold.co/800x600?text={$text}&font=roboto",
            'slug' => Str::slug($title), // автоматически генерируем slug
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
