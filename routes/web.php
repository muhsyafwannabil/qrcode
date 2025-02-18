<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman registrasi
Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register.show');

// Route untuk menangani registrasi
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Route untuk halaman profil user setelah registrasi

Route::get('/profile/{id}', [RegisterController::class, 'showProfile'])->name('user.profile');

