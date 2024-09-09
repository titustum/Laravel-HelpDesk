<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     private static $designations = [
        'Software Engineer',
        'Project Manager',
        'Business Analyst',
        'UX Designer',
        'Product Owner',
        'Data Scientist',
        'HR Specialist',
        'Marketing Coordinator',
        'Sales Representative',
        'Customer Support Specialist',
    ];

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'department_id' => Department::inRandomOrder()->first()->id,
            'office_number' => $this->faker->unique()->numerify('Office ###'),
            'designation' => $this->faker->randomElement(self::$designations),
            'extension_number' => $this->faker->unique()->numerify('Ext ###'),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTime(),
            'password' => Hash::make('password'), // Ensure to hash the password
            'role' => $this->faker->randomElement(['client', 'officer', 'admin']),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
