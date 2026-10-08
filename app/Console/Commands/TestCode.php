<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:test-code')]
#[Description('Command description')]
class TestCode extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $firstStudent = Student::query()->first();

        $courses = $firstStudent->courses;
        $this->line("Student: {$firstStudent->name} (ID: {$firstStudent->id})");
        $this->line($courses->toJson(
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ));


//        $this->table(
//            ['ID', 'Name', 'Outline'],
//            $courses->map(fn ($course): array => [
//                $course->id,
//                $course->name,
//                $course->outline,
//            ])->all(),
//        );
    }
}
