<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\InvoiceController;

Route::prefix('api/public')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.public.categories');
    Route::get('/products', [ProductController::class, 'index'])->name('api.public.products');
    Route::get('/Indexproducts', [ProductController::class, 'productIndex']);
    Route::get('/product/{id}', [ProductController::class, 'detail']);
});

// Product filtering
Route::prefix('products/filter')->controller(ProductController::class)->group(function () {
    Route::get('/new/{limit?}', 'getNewProduct');
    Route::get('/price-range', 'getProductsInPriceRange');
    Route::get('/top-selling/{limit}', 'getTopSelling');
    Route::get('/search/{inputString}', 'getProductsBySearching');
    Route::get('/most-profitable', 'getMostProfitableProducts');
    Route::get('/current-month', 'getCurrentMonthNewProduct');
    Route::get('/out-of-stock', 'getOutOfStockProducts');
    Route::get('/discount', 'getDisCountProduct');
});

Route::controller(InvoiceController::class)->prefix('invoices')->name('invoices.')->group(function () {
    Route::get('/index', 'index')->name('index');
});
