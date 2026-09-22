<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::firstOrCreate([
            'initials' => 'AS',
            'name' => 'Ayobamidele Setemi',
            'gender' => 'male',
            'course' => 'Backend Development',
            'duration_in_months' => 6,
        ]);

        Student::factory()->count(10)->create();
    }
}
