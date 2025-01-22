<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('layouts.patisserieApp');
});

<<<<<<< HEAD
Route::prefix('admin')->name('admin')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

=======
>>>>>>> d0ad93032767e352bd422a1a7a7c9fcf783e39a1

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__.'/auth.php';
