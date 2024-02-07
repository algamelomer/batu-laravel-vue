<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'name' => $this->faker->word,
        //     'faculty_id' => $this->faker->numberBetween(1, 2),
        //     'description' => $this->faker->paragraph(),
        //     'image' => $this->faker->imageUrl(),
        //     'video' => $this->faker->imageUrl(),
        //     'user_id' => null,
        //     'job_opportunities' => $this->faker->randomElements(['Quick access to the job market', 'Working in the field of electronics manufacturing', 'Working in the field of electronics repair'], $count = 2),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ];
        $departments = [
            [
                'name' => 'Information Technology',
                'faculty_id' => 1,
                'description' => "Discover cutting-edge Information Technology programs, shaping innovators for tomorrow's digital landscape. Unleash your potential with us.",
                'image' => 'https://img.freepik.com/free-vector/desktop-smartphone-app-development_23-2148683810.jpg?size=626&ext=jpg&ga=GA1.1.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Software Developer', 'Network Engineer'],
            ],
            [
                'name' => 'Pharmacy Assistant',
                'faculty_id' => 2,
                'description' => "Prepare for a career as a Pharmacy Assistant. Gain the skills and knowledge needed to assist pharmacists in various healthcare settings.",
                'image' => 'https://img.freepik.com/free-vector/pharmacist-concept-illustration_114360-2901.jpg?size=626&ext=jpg&ga=GA1.2.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Pharmacy Assistant', 'Pharmacy Technician'],
            ],
            [
                'name' => 'Nursing Assistant',
                'faculty_id' => 2,
                'description' => "Embark on a rewarding journey as a Nursing Assistant. Learn essential skills to support healthcare professionals and make a difference in patient care.",
                'image' => 'https://img.freepik.com/free-vector/flat-national-nurses-day-illustration_23-2148898658.jpg?size=626&ext=jpg&ga=GA1.1.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Nursing Assistant', 'Patient Care Assistant'],
            ],
            [
                'name' => "Railway technology",
                'faculty_id' => 2,
                'description' => "Embark on a rewarding journey as a Nursing Assistant. Learn essential skills to support healthcare professionals and make a difference in patient care.",
                'image' => 'https://img.freepik.com/free-vector/high-speed-transport-abstract-concept-illustration_335657-3926.jpg?size=626&ext=jpg&ga=GA1.1.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Nursing Assistant', 'Patient Care Assistant'],
            ],
            [
                'name' => "Textile technology",
                'faculty_id' => 2,
                'description' => "Embark on a rewarding journey as a Nursing Assistant. Learn essential skills to support healthcare professionals and make a difference in patient care.",
                'image' => 'https://img.freepik.com/free-vector/professional-sewing-classes-vocational-education-clothes-manufacturing-seamstress-training-handmade-clothing-production-dressmaking-courses_335657-140.jpg?size=626&ext=jpg&ga=GA1.1.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Nursing Assistant', 'Patient Care Assistant'],
            ],
            [
                'name' => "Technology of tractors and agricultural equipment",
                'faculty_id' => 2,
                'description' => "Embark on a rewarding journey as a Nursing Assistant. Learn essential skills to support healthcare professionals and make a difference in patient care.",
                'image' => 'https://img.freepik.com/free-vector/farming-robots-isometric-composition_1284-23024.jpg?size=626&ext=jpg&ga=GA1.1.1851756999.1695294167&semt=ais',
                'video' => null,
                'user_id' => 1,
                'job_opportunities' => ['Nursing Assistant', 'Patient Care Assistant'],
            ],
        ];

        $randomDepartment = $this->faker->randomElement($departments);

        return [
            'name' => $randomDepartment['name'],
            'faculty_id' => $randomDepartment['faculty_id'],
            'description' => $randomDepartment['description'],
            'image' => $randomDepartment['image'],
            'video' => $randomDepartment['video'],
            'user_id' => $randomDepartment['user_id'],
            'job_opportunities' => $randomDepartment['job_opportunities'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
