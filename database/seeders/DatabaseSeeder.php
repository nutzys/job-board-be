<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed premade data for Seniority, JobType, and Industry
        $this->call([
            SenioritySeeder::class,
            JobTypeSeeder::class,
            IndustrySeeder::class,
            RoleSeeder::class,
        ]);
    }
}
