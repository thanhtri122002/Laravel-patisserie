<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Models\Product;
use App\Services\user\ProductDetailService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () use ($event) {

            $productDetail = $event->productDetail;
            $quantityPurchased = $event->productDetail->quantity;
            $productId = $productDetail->product_id;
            $product = Product::where('id', $productId)->lockForUpdate()->first();
            if ($product) {
                if ($product->stock >= $quantityPurchased) {
                    $product->update(['stock' => $product->stock - $quantityPurchased]);
                }
                else {
                    throw new \Exception('Not enough stock available');
                }
            }
        });
    }
}
