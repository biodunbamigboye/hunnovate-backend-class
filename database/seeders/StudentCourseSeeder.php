<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;
use RuntimeException;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseIds = Course::pluck('id');

        if ($courseIds->count() < 4) {
            throw new RuntimeException('At least four courses are required to seed student courses.');
        }

        foreach (Student::lazyById() as $student) {
            $student->courses()->syncWithoutDetaching($courseIds->random(4)->all());
        }
    }
}
