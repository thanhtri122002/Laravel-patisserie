<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AdminAuthController as ControllersAdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('homepage');
});

// array:4 [ // app\Http\Controllers\AdminAuthController.php:32
//     "_token" => "N849ILIqTB6INYYVvDQHk4EsO3Rmob8hYdotwoRn"
//     "_flash" => array:2 [
//       "old" => []
//       "new" => []
//     ]
//     "login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d" => 1
//     "_previous" => array:1 [
//       "url" => "http://127.0.0.1:8000/admin/dashboard"
//     ]
//   ]

// array:4 [ // app\Http\Controllers\Admin\AdminAuthController.php:34
//     "_token" => "WwLpHSy4nDYZ2xRwabfa4ODIbKrWSjLvKMASaaCK"
//     "login_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d" => 1
//     "_flash" => array:2 [
//       "old" => []
//       "new" => []
//     ]
//     "_previous" => array:1 [
//       "url" => "http://127.0.0.1:8000/admin/dashboard"
//     ]
//   ]
// Route::prefix('admin')->name('admin.')->group(function() {
//     // Public login routes
//     Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
//     Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
//     Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

//     // Admin dashboard, protected by auth middleware
//     Route::middleware(['auth:admin'])->get('dashboard', [AdminAuthController::class, 'showDashboard'])->name('dashboard');

//     // Admin actions inside the dashboard (protected by auth)
//     Route::middleware(['auth:admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
//         Route::post('create', [AdminAuthController::class, 'create'])->name('create');
        
        
//     }); 
// });

Route::prefix('admin')->name('admin.')->group(function() {

    Route::controller(AdminAuthController::class)->group(function() {

        Route::get('login', 'showLoginForm')->name('login');
        Route::post('login', 'login')->name('login.submit');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::middleware('auth:admin')->prefix('dashboard')->group(function() {

        Route::get('/', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
        Route::post('create', [AdminAuthController::class, 'store'])->name('store');

        Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function() {

            Route::get('/{id}', 'detail')->name('detail');
            Route::post('/', 'store')->name('store');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'delete')->name('delete');
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
