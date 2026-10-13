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
   // Route::resource('dashboard/places', PlaceController::class)->except('show')->names('admin.places');
    // expand the resource route to individual routes for better control
    Route::get('dashboard/places', [PlaceController::class, 'index'])->name('admin.places.index');
    Route::get('dashboard/places/create', [PlaceController::class, 'create'])->name('admin.places.create');
    Route::post('dashboard/places', [PlaceController::class, 'store'])->name('admin.places.store');

    Route::get('dashboard/places/{place}/edit', [PlaceController::class, 'edit'])->name('admin.places.edit');

//    Route::put('dashboard/places/{place}', [PlaceController::class, 'update'])->name('admin.places.update');
//    Route::delete('dashboard/places/{place}', [PlaceController::class, 'destroy'])->name('admin.places.destroy');
});

Route::get('/', [StudentListController::class, 'index']);
Route::post('assign-course/{studentId}', [StudentListController::class, 'assignCourse'])->name('assign-course');

Route::get('places', [PlaceDirectoryController::class, 'index'])->name('places.index');
Route::get('places/{place}', [PlaceDirectoryController::class, 'show'])->name('places.show');

