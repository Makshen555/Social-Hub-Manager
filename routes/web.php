<?php

use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// INITIAL PAGE
Route::get('/', function () {
    return view('welcome');
});

// HOME PAGE
Route::get('/home', function () {
    return view('home');
});

Route::get('register', [RegisterController::class, 'create']);
Route::post('registrar', [RegisterController::class, 'store']);

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

