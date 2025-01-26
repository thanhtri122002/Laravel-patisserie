<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('homepage');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    
    Route::get('dashboard', [AdminAuthController::class, 'index'])->name('dashboard');
    Route::post('create', [AdminAuthController::class, 'create'])->name('create');
    Route::post('update', [AdminAuthController::class, 'update'])->name('update');
    
});

//All route require to protect sensitive info will need to be implements the authentication of middleware

//Note: prefix user + login => user/login
Route::prefix('user')->name('user.')->group(function() {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::post('register', [UserAuthController::class, 'create'])->name('create');
});

Route::middleware('auth')->group(function() {
});
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
