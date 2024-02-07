<?php

namespace Database\Factories;
use Illuminate\Support\Facades\File;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $imageUrls = [
            'https://ziad-abaza.github.io/article/images/article/article-3.jpg',
            'https://ziad-abaza.github.io/article/images/article/article-2.jpg',
            'https://ziad-abaza.github.io/article/images/article/article-6.jpg',
            'https://ziad-abaza.github.io/mohamed-hassan-magazine-main/images/article/article-(2).jpeg',
            'https://ziad-abaza.github.io/mohamed-hassan-magazine-main/images/article/article-(1).jpeg',
            'https://ziad-abaza.github.io/mohamed-hassan-magazine-main/images/article/article-(3).jpeg',
            'https://ziad-abaza.github.io/article/images/article/article-(3).jpg',
        ];

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'user_id' => $this->faker->numberBetween(1,10),
            'file' => $this->faker->randomElement($imageUrls),
            'file_type' => $this->faker->randomElement(['video', 'image']),
            'type' => 'news',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
