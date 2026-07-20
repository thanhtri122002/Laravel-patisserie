<?php

namespace App\Jobs;

use App\Models\ProductDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ReduceProductStocks implements ShouldQueue
{
    use Queueable;

    protected $productDetail;
    /**
     * Create a new job instance.
     */
    public function __construct(ProductDetail $productDetail)
    {
        $this->productDetail = $productDetail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productId = $this->productDetail->product_id;
        
    }
}
