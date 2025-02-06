<?php

namespace App\Providers;

use App\Models\ProductDetail;
use App\Observers\ProductDetailObserver;
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
        ProductDetail::observe(ProductDetailObserver::class);
    }
}
