<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Observers\InvoiceObserver;
use App\Observers\ProductDetailObserver;
use App\Observers\ProductObserver;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        //Observers
        ProductDetail::observe(ProductDetailObserver::class);
        Product::observe(ProductObserver::class);
        Invoice::observe(InvoiceObserver::class);
        
        //Custom urls for reset password function 
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return match (true) {
                $user instanceof Admin => 'http://localhost:8000/admin/reset-password' . '?token=' . $token . '&email=' . urlencode($user->email),
                $user instanceof User => 'http://localhost:8000/user/reset-password' . '?token=' . $token . '&email=' . urlencode($user->email),
                // other user types
                default => throw new \Exception("Invalid user type"),
            };
        });

    }
}
