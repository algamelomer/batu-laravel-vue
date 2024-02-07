<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $collegeNames = ['College of Health Sciences', 'College of Industry and Energy'];

        $imageUrls = [
            'https://www.it-club.top/logos/1702653027.jpg',
            'https://www.it-club.top/logos/1702653039.jpg',
        ];

        return [
            'name' => $this->faker->randomElement($collegeNames),
            'image' => $this->faker->randomElement($imageUrls),
            'video' => null,
            'description' => $this->faker->paragraph,
            'vision' => $this->faker->sentence,
            'mission' => $this->faker->sentence,
            'user_id' => $this->faker->numberBetween(1,10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
