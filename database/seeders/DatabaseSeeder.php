<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Models\Problem;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use ProblemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Department::factory(8)->create();
        User::factory(34)->create();
        Problem::factory(50)->create();

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
