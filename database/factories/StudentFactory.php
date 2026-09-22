<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();

        return [
            'name' => $firstName . ' ' . $lastName,
            'initials' => strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1)),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'course' => $this->faker->randomElement(['Backend Development', 'Frontend Development', 'Data Science']),
            'duration_in_months' => $this->faker->randomElement([6, 12, 18])
        ];
    }
}
