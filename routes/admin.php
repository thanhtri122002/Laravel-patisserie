<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
    });

    // Protected routes
    Route::middleware('auth:admin')->prefix('dashboard')->group(function () {
        Route::get('/', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
        Route::post('create', [AdminAuthController::class, 'store'])->name('store');

        // Categories
        Route::controller(CategoryController::class)
            ->prefix('categories')->name('categories.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'create')->name('create');
                Route::post('/{id}', 'update')->name('update');
                Route::post('/{id}/delete', 'delete')->name('delete');
            });

        // Products
        Route::controller(ProductController::class)
            ->prefix('products')->name('products.')
            ->group(function () {
                Route::post('/', 'store')->name('store');
                Route::get('/{id}', 'detail')->name('detail');
                Route::post('/{id}', 'update')->name('update');
                Route::post('/{id}/delete', 'delete')->name('delete');
            });

        // Product Images
        Route::controller(ProductImageController::class)
            ->prefix('productImages')->name('productImages.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{id}', 'detail')->name('detail');
                Route::post('/{id}', 'update')->name('update');
                Route::post('/{id}/delete', 'delete')->name('delete');
            });
    });
});
