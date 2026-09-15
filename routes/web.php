<?php

use App\Http\Controllers\StudentListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', fn() => view('login'));
Route::get('/list', [StudentListController::class, 'index']);
