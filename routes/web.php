<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('home')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    });
    Route::get('teams', function () {
        return view('Teams');
    });

    Route::get('products', function () {
        return view('products');
    });

    Route::get('products/{id}', function ($id) {
        return view("productInfo", ['productId' => $id]);
    });
    Route::get('cart', function () {
        return view('cart');
    });
    Route::view('contact', 'contact');
    
});
Route::get('/authToggle', function () {
    return view('auth_form_toggle', [
        'hideHeader' => true,
        'hideFooter' => true,
    ]);
})->name('user.auth');
Route::get('forgot-password', function () {
    return view(
        'auth.forgot-password',
        [
            'hideHeader' => true,
            'hideFooter' => true,
        ]
    );
});


Route::prefix('api/public')->name('public')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('api.public.categories');
    Route::get('/products', [ProductController::class, 'index'])->name('api.public.products');
    Route::get('/Indexproducts', [ProductController::class, 'productIndex']);
    Route::get('/product/{id}', [ProductController::class, 'detail']);
});
Route::prefix('products/filter')->controller(ProductController::class)->group(function () {
    Route::get('/new/{limit?}', 'getNewProduct');
    Route::get('/price-range', 'getProductsInPriceRange');
    Route::get('/top-selling/{limit}', 'getTopSellingProducts');
    Route::get('/search/{inputString}', 'getProductsBySearching');
    Route::get('/most-profitable/{limit}', 'getMostProfitableProducts');
    Route::get('/current-month', 'getCurrentMonthNewProduct');
    Route::get('/out-of-stock', 'getOutOfStockProducts');
    Route::get('/discount', 'getDisCountProduct');
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::controller(AdminAuthController::class)->group(function () {

        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::middleware('auth:admin')->prefix('dashboard')->group(function () {

        Route::get('/', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
        Route::post('create', [AdminAuthController::class, 'store'])->name('store');

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

//All route require to protect sensitive info will need to be implements the authentication of middleware

//Note: prefix user + login => user/login

Route::prefix('user')->name('user.')->group(function () {

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'show'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'handle'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'handle'])->name('password.create');

    Route::controller(UserAuthController::class)->group(function () {

        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
        Route::post('register', 'register')->name('register');
    });

    Route::middleware("auth")->group(function () {
        
        Route::controller(PaymentController::class)->prefix('checkoutSession')->name('checkout.')->group(function () {
            
            Route::view('/checkout', 'checkoutPage');
            Route::view('/complete', 'checkoutPage');
            Route::post('/createSession/{id}', 'checkoutSession')->name('checkoutSession');
            Route::post('/retrieve-status', 'retrieveStatus')->name('retrieveStatus');
           
        });

        Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {

            Route::post('/submit', 'submitCart')->name('submit'); 
            Route::post('/', 'addToCart')->name('addProduct');
            Route::post('/{productDetailId}', 'update')->name('updateProductDetail');
            Route::post('/{productDetailId}/delete', 'deleteProduct')->name('deleteProductDetail');
            Route::get('/', 'getCart')->name('getCart');
            Route::get('/cost', 'getCartCost')->name('cost');
        });

        Route::controller(InvoiceController::class)->prefix('invoices')->name('invoices.')->group(function () {
            Route::get('/{id}', 'detail')->name('detail');
        });
    });
});
