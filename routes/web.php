<?php

use App\Http\Controllers\StudentListController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/login', fn() => view('login'));
Route::get('/', [StudentListController::class, 'index']);
Route::post('assign-course/{studentId}', [StudentListController::class, 'assignCourse'])->name('assign-course');
