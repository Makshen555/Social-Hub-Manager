<?php

use \App\Http\Controllers\RegisterController;
use \App\Http\Controllers\SessionController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\LinkedInPostController;
use Illuminate\Support\Facades\Route;

// INITIAL PAGE
Route::get('/', function () {
    return view('welcome');
});

// HOME PAGE
Route::get('/home', function () {
    return view('home');
});

// REGISTER
Route::get('register', [RegisterController::class, 'create']);
Route::post('registrar', [RegisterController::class, 'store']);

// LOGIN
Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

// POST FORM
Route::get('/postForm', [PostController::class, 'showForm'])->name('show_Form');

// LINKEDIN
Route::post('/linkedin/post', [LinkedInPostController::class, 'store'])->name('linkedin.store');