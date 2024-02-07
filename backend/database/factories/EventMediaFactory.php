<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventMedia>
 */
class EventMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageUrls = [
            'https://th.bing.com/th/id/OIP.a8MXvifdF742qmsNkADDuAHaEP?w=328&h=187&c=7&r=0&o=5&pid=1.7',
            'https://th.bing.com/th/id/OIP.YWNblpswlZV35859R1sFMwHaEL?w=305&h=180&c=7&r=0&o=5&pid=1.7',
            'https://th.bing.com/th/id/OIP.x7-OzwEA5T7uvKaScbbxywHaE8?w=252&h=180&c=7&r=0&o=5&pid=1.7',
            'https://th.bing.com/th?id=OIF.GvLA0C%2bcs3TqivB9FTYOjA&w=234&h=180&c=7&r=0&o=5&pid=1.7',
        ];

        return [
            'event_id' => $this->faker->numberBetween(1, 4),
            'file' => $this->faker->randomElement($imageUrls),
            'type' => 'image',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
