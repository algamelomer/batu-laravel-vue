<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();
        \App\Models\Faculty::factory(2)->create();
        \App\Models\department::factory(6)->create();
        \App\Models\post::factory(10)->create();
        \App\Models\Event::factory(4)->create();
        \App\Models\EventMedia::factory(4)->create();
        \App\Models\Job::factory(7)->create();
        \App\Models\JobApplication::factory(7)->create();
        \App\Models\FacultyMember::factory(10)->create();
        \App\Models\StudentProjects::factory(3)->create();
        \App\Models\StudyPlan::factory(2)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
            'role'  => 'superAdmin',
        ]);
    }
}
