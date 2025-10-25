<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentController;

Route::prefix('user')->name('user.')->group(function () {

    // Password reset routes
    Route::controller(PasswordResetLinkController::class)->group(function () {
        Route::get('/forgot-password', 'show')->name('password.request');
        Route::post('/forgot-password', 'handle')->name('password.email');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/reset-password/{token}', 'show')->name('password.reset');
        Route::post('/reset-password', 'handle')->name('password.create');
    });

    // Auth routes
    Route::controller(UserAuthController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
        Route::post('register', 'register')->name('register');
    });

    // Authenticated routes
    Route::middleware('auth')->group(function () {
        // Checkout
        Route::controller(PaymentController::class)
            ->prefix('checkoutSession')->name('checkout.')
            ->group(function () {
                Route::view('/checkout', 'checkoutPage');
                Route::view('/complete', 'checkoutPage');
                Route::post('/createSession/{id}', 'checkoutSession')->name('checkoutSession');
                Route::post('/retrieve-status', 'retrieveStatus')->name('retrieveStatus');
            });

        // Cart
        Route::controller(CartController::class)
            ->prefix('cart')->name('cart.')
            ->group(function () {
                Route::post('/submit', 'submitCart')->name('submit');
                Route::post('/', 'addToCart')->name('addProduct');
                Route::post('/{productDetailId}', 'update')->name('updateProductDetail');
                Route::post('/{productDetailId}/delete', 'deleteProduct')->name('deleteProductDetail');
                Route::get('/', 'getCart')->name('getCart');
                Route::get('/cost', 'getCartCost')->name('cost');
            });

        // Invoices
        Route::controller(InvoiceController::class)
            ->prefix('invoices')->name('invoices.')
            ->group(function () {
                Route::get('/{id}', 'detail')->name('detail');
            });
    });
});
