<?php

namespace App\Observers;

use App\Events\PriceChange;
use App\Models\Product;
use App\Services\StripeService;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{   
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
        $this->stripeService->createStripeProduct($product);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->stripeService->updateStripeProduct($product);
        $user = Auth::user();
        if($product->wasChanged('price')){
            PriceChange::dispatch($product, $user);
        }
    }

    public function deleting(Product $product): void 
    {
        $this->stripeService->removeProduct($product);
      
    }
    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
