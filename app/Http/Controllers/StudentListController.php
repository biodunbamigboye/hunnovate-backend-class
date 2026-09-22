<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentListController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $studentList = Student::all();

        return view('list', [
            'studentList' => $studentList->toArray()
        ]);
    }

    public function show(int $studentId): Student|Builder
    {
        $student = DB::table('students')
            ->where('id', $studentId)
            ->first();

        $studentWithRawQuery = DB::raw("SELECT * FROM students WHERE id = 10");

        $studentsWithRawEscapedQuery = DB::select(DB::raw("SELECT * FROM students WHERE id = :id"), [
            'id' => $studentId
        ]);
    }
}
