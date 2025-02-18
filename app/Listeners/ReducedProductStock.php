<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Models\Product;
use App\Services\user\ProductDetailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ReducedProductStock implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

   
    /**
     * Handle the event.
     */
    public function handle(ProductPurchased $event): void
    {
        //
        $productDetail = $event->productDetail;
        $quantityPurchased = $event->productDetail->quantity;
        $productId = $productDetail->product_id;
        $product = Product::find($productId);
        if ($product) {
            $product->update(['stock' => $product->stock - $quantityPurchased]);
        }
        
    }
}
