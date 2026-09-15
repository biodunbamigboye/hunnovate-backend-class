<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', fn() => view('login'));
Route::get('/list', fn() => view('list'));
