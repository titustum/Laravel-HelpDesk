<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Problem;
use App\Models\User;
use Illuminate\Support\Str;

class ProblemFactory extends Factory
{
    protected $model = Problem::class;


    private function generateTicket()
    {
        return "TKT-" . strtoupper(uniqid());
    }

    public function definition()
    {
        $client = User::where('role', 'client')->inRandomOrder()->first();

        return [
            'ticket' => $this->generateTicket(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['open', 'resolved', 'elevated', 'closed']),
            'assigned_to' =>$this->faker->randomElement([null,User::inRandomOrder()->where('role','officer')->first()->id]),
            'created_by' => User::inRandomOrder()->where('role','client')->first()->id,
            'solution' => $this->faker->optional()->paragraph(),
            'resolved_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
