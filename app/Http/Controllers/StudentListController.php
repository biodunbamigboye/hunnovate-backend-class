<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\StudentModel;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentListController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $studentList = Student::all();

        return view('list', [
            'studentList' => $studentList,
        ]);
    }

    public function show(int $studentId): Student|Builder
    {
        // Query Builder
        $student = DB::table('students')
            ->where('id', $studentId)
            ->first();

        // Raw Query
        $studentWithRawQuery = DB::raw("SELECT * FROM students WHERE id = $studentId");

        // Raw Query with Escaped Parameters
        $studentsWithRawEscapedQuery = DB::select(DB::raw("SELECT * FROM students WHERE id = :id"), [
            'id' => $studentId
        ]);

        // Using Mdodel and Eloquent
        $studentWithModel = Student::find($studentId);

        // using eloquent query builder
        $studentWithEloquentQueryBuilder = Student::query()->where('id', $studentId)->first();
    }


    public static function getStudent(int $studentId): mixed
    {

        $getStudent = \App\Models\StudentModel::query()->whereDate('created_at', '2026-09-12')->first();

                $getStudent = \App\Models\StudentModel::query()->whereDate('created_at', '2026-09-12')->first();
                        $getStudent = \App\Models\StudentModel::query()->whereBetween('created_at', ['2026-09-12', '2026-09-16'])->first();

    }

    public function assignCourse(Request $request, int $studentId): RedirectResponse
    {
        $payload = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($studentId);
        $student->course_id = $payload['course_id'];
        $student->save();

        return redirect()->back()->with('success', 'Course assigned successfully.');
    }
}
