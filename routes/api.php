<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminAuthController::class)->group(function () {
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::middleware('cookie.sancAuth')->prefix('dashboard')->name('dashboard.')->group(function () {

        Route::get('/currentAdmin', [AdminAuthController::class, 'getCurrentAuthUser'])->name('admin');
        Route::post('/create', [AdminAuthController::class, 'store'])->name('store');
        Route::controller(DashboardController::class)->prefix('coreStat')->name('coreStat')->group(function () {
            
            Route::get('/revenue', 'getRevenue')->name('revenue');
            Route::get('/dailyRevenue', 'getDailyRevenue')->name('dailyRevenue');
            Route::get('/monthlyRevenue', 'getMonthlyRevenue')->name('monthlyRevenue');
            Route::get('/annualRevenue', 'getAnnualRevenue')->name('annualRevenue');
            Route::get('/monthGrowthRate', 'getMonthGrowthRate')->name('monthGrowthRate');
        });

        Route::controller(CategoryController::class)->prefix('categories')->name('categories.')->group(function () {

            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'create'])->name('create');
            Route::post('/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('/{id}/delete', [CategoryController::class, 'delete'])->name('delete');
        });

        Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {

            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'detail')->name('detail');
            Route::post('/{id}', 'update')->name('update');
            Route::post('/{id}/delete', 'delete')->name('delete');
        });

        Route::controller(ProductImageController::class)->prefix('productImages')->name('productImages.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'detail')->name('detail');
            Route::post('/{id}', 'update')->name('update');
            Route::post('/{id}/delete', 'delete')->name('delete');
        });
    });
});
