<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('homepage');
});

Route::prefix('admin')->name('admin.')->group(function() {

    Route::controller(AdminAuthController::class)->group(function() {

        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::middleware('auth:admin')->prefix('dashboard')->group(function() {

        Route::get('/', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
        Route::post('create', [AdminAuthController::class, 'store'])->name('store');

        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function() {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'create'])->name('create');
            Route::post('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');

        });

        Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function() {

            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'detail')->name('detail');
            Route::post('/{id}', 'update')->name('update');
            Route::post('/{id}/delete', 'delete')->name('delete');
        });


    });
});


//All route require to protect sensitive info will need to be implements the authentication of middleware

//Note: prefix user + login => user/login


Route::prefix('user')->name('user.')->group(function() {
    Route::controller(UserAuthController::class)->group(function() {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
    });

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
