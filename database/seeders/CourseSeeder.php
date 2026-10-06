<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 10 Tech Related Courses
        $courses = [
            ['name' => 'Web Development', 'outline' => 'Learn to build websites and web applications using HTML, CSS, JavaScript, and popular frameworks.'],
            ['name' => 'Data Science', 'outline' => 'Explore data analysis, machine learning, and statistical modeling using Python and R.'],
            ['name' => 'Cybersecurity', 'outline' => 'Understand the principles of securing networks, systems, and data from cyber threats.'],
            ['name' => 'Mobile App Development', 'outline' => 'Develop mobile applications for iOS and Android platforms using native and cross-platform tools.'],
            ['name' => 'Cloud Computing', 'outline' => 'Learn about cloud services, deployment models, and how to manage cloud infrastructure.'],
            ['name' => 'Artificial Intelligence', 'outline' => 'Dive into AI concepts, neural networks, and deep learning techniques.'],
            ['name' => 'Blockchain Technology', 'outline' => 'Understand blockchain principles, cryptocurrencies, and decentralized applications.'],
            ['name' => 'Internet of Things (IoT)', 'outline' => 'Explore IoT devices, sensors, and how to build connected systems.'],
            ['name' => 'Game Development', 'outline' => 'Learn to create engaging video games using popular game engines like Unity and Unreal Engine.'],
            ['name' => 'DevOps', 'outline' => 'Understand the practices of continuous integration, continuous delivery, and infrastructure as code.']
        ];

        foreach ($courses as $course) {
            \App\Models\Course::create($course);
        }

        // use insert to add the courses to the database
         \App\Models\Course::insert($courses);
    }
}
