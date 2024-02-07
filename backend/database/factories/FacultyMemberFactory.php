<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FacultyMember>
 */
class FacultyMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl,
            'title' => $this->faker->word,
            'sub_title' => $this->faker->word,
            'career' => $this->faker->paragraph,
            'scientific_interests' => $this->faker->paragraph,
            'experience' => $this->faker->paragraph,
            'user_id' =>$this->faker->numberBetween(1,10),
            'department_id' => $this->faker->numberBetween(1, 6),
            'faculty_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
