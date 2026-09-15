<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentListController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $studentList = [
            [
                'initials' => 'AS',
                'name' => 'Ayobamidele Setemi',
                'gender' => 'male',
                'course' => 'Backend Development',
                'duration' => '6 months',
            ],
            [
                'initials' => 'JD',
                'name' => 'John Doe',
                'gender' => 'female',
                'course' => 'Frontend Development',
                'duration' => '5 months',
            ],
            [
                'initials' => 'MS',
                'name' => 'Mary Smith',
                'gender' => 'female',
                'course' => 'Fullstack Development',
                'duration' => '8 months',
            ],
            [
                'initials' => 'RB',
                'name' => 'Robert Brown',
                'gender' => 'male',
                'course' => 'Data Science',
                'duration' => '7 months',
            ],
        ];

        return view('list', [
            'studentList' => $studentList
        ]);
    }
}
