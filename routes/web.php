<?php

use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlaceDirectoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentListController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//    return view('welcome');
// });

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
});
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');
Route::middleware(['auth', 'can:manage-places'])->group(function (): void {
    Route::redirect('/dashboard', '/dashboard/places')->name('dashboard');
    Route::resource('dashboard/places', PlaceController::class)->except('show')->names('admin.places');
});
Route::resource('places', PlaceDirectoryController::class)->only(['index', 'show']);
Route::get('/', [StudentListController::class, 'index']);
Route::post('assign-course/{studentId}', [StudentListController::class, 'assignCourse'])->name('assign-course');
