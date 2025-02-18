<?php

namespace App\Listeners;

use App\Events\PriceChange;
use App\Models\ProductDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeCartProductDetailPrice implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    private function getProductDetail($id)
    {
        return ProductDetail::where('product_id', $id)->get();
    }
    /**
     * Handle the event.
     */
    public function handle(PriceChange $event): void
    {
        //
        $productDetails = $this->getProductDetail($event->product->id);

        foreach ($productDetails as $detail) {
            $detail->update(['cost' => $detail->calculateTotal()]);
        }
    }
}
