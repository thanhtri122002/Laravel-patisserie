<?php

namespace App\Observers;

use App\Events\ProductPurchased;
use App\Models\Invoice;
use App\Models\ProductDetail;

class ProductDetailObserver
{
    /**
     * Handle the ProductDetail "created" event.
     * If the product detail is in the cart, no need to reducde the product'stocks
     */
    public function created(ProductDetail $productDetail): void
    {
        //
        //event(new ProductPurchased($productDetail));
        
    }

    /**
     * Handle the ProductDetail "updated" event.
     */
    public function updated(ProductDetail $productDetail): void
    {
        //
    }

    /**
     * Handle the ProductDetail "deleted" event.
     */
    public function deleted(ProductDetail $productDetail): void
    {
        //
    }

    /**
     * Handle the ProductDetail "restored" event.
     */
    public function restored(ProductDetail $productDetail): void
    {
        //
    }

    /**
     * Handle the ProductDetail "force deleted" event.
     */
    public function forceDeleted(ProductDetail $productDetail): void
    {
        //
    }
    /**
     * Handle the ProductDetail updating event
     * This stops the product detail of the paid invoice from updating 
     */
    public function updating(ProductDetail $productDetail): void
    {
        if ($productDetail->invoice === null) {
            return;
        }

        if ($productDetail->invoice->status == Invoice::PAID) {
            throw new \Exception('you can not update the product detail of the paid invoice');
        }
        
    
    }
    /**
     * Handle the ProductDetail deleting event
     * This stops the product detail of the paid invoice from deleting 
     */
    public function deleting(ProductDetail $productDetail): void
    {   
        if($productDetail->invoice === null) {
            return;
        }    

        if($productDetail->invoice->status == Invoice::PAID) {
            throw new \Exception('you can not delete the product detail of the paid invoice');
        }

        
    }
}
