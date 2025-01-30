<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\AdminAuthController as ControllersAdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
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
Route::prefix('admin')->name('admin.')->group(function() {
    // Public login routes
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Admin dashboard, protected by auth middleware
    Route::middleware(['auth:admin'])->get('dashboard', [AdminAuthController::class, 'showDashboard'])->name('dashboard');

    // Admin actions inside the dashboard (protected by auth)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::post('create', [AdminAuthController::class, 'create'])->name('create');
        
    });
});


//All route require to protect sensitive info will need to be implements the authentication of middleware

//Note: prefix user + login => user/login
Route::prefix('user')->name('user.')->group(function() {
    Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout'])->name('logout');
    Route::post('register', [UserAuthController::class, 'create'])->name('create');
    Route::middleware('auth')->get('profile', []);
    Route::middleware('auth')->prefix('dashboard')->name('dashboard')->group(function () {
        Route::get('/', [UserAuthController::class]);
        
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
