<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardCategoryController; // Jangan lupa import ini
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan
Route::get('/', [PostController::class, 'index']);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Login & Register
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard Utama
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Dashboard Posts (CRUD Berita)
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Komentar
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

// KATEGORI (Hanya Admin)
// Perhatikan bagian middleware('can:admin')
Route::resource('/dashboard/categories', DashboardCategoryController::class)
    ->middleware('auth')
    ->middleware('can:admin');