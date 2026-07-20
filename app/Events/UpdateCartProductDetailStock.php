<?php

namespace App\Events;

use App\Models\ProductDetail;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateCartProductDetailStock
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productDetail;
    public $delta;
    /**
     * Create a new event instance.
     */
    public function __construct(ProductDetail $productDetail, $delta)
    {
        $this->productDetail = $productDetail;
        $this->delta = $delta;
    }
}
