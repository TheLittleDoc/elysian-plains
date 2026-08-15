<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Register;

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ElysianController;

Route::get('/', [ElysianController::class, 'index'])
->name('home');

// Registration routes
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

// Login routes
Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', LoginController::class)
    ->middleware('guest');

// Logout route
Route::post('/logout', LogoutController::class)
    ->middleware('auth')
    ->name('logout');

// posts.create
Route::resource('posts', PostController::class)
    ->only(['index','show','store', 'edit', 'update', 'destroy']);

// update view
Route::view('/profile', 'auth.profile')
    ->middleware('auth')
    ->name('profile');

// update profile route
Route::post('/profile', \App\Http\Controllers\Auth\UpdateProfile::class)
    ->middleware('auth')
    ->name('profile.update');

Route::feeds();
