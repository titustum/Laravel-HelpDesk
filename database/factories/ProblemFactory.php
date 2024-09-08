<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Support\Str;

class ProblemFactory extends Factory
{
    protected $model = Problem::class;

    public function definition()
    {
        $client = User::where('role', 'client')->inRandomOrder()->first();

        return [
            'client_name' => $this->faker->name,
            'client_phone' => $this->faker->phoneNumber,
            'client_email' => $this->faker->safeEmail,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Open', 'In Progress', 'Resolved', 'Closed']),
            'assigned_to' => null,
            'created_by' => $client->id, // same as above
            'solution' => $this->faker->optional()->paragraph,
            'resolved_at' => $this->faker->optional()->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => $this->faker->optional()->dateTime, // for soft deletes
        ];
    }
}
