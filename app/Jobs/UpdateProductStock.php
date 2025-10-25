<?php

namespace App\Jobs;

use App\Events\ProductStockUpdated;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdateProductStock implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    public $productId;
    public $delta;

    public $tries = 5;
    public $uniqueFor = 8;
    public $backoff = 3;
    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     */
    public function __construct($productId, $delta)
    {
        $this->productId = $productId;
        $this->delta = $delta;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = DB::transaction(function ()  {
            $product = Product::lockForUpdate()->findOrFail($this->productId);
            if ($this->delta > 0) {
                $product->decrement('stock', $this->delta);
    
            } elseif ($this->delta < 0) {
                $product->increment('stock', abs($this->delta));
            }
            $product->refresh();

            return $product;
        });
        
        ProductStockUpdated::dispatch($product);
    }
}
