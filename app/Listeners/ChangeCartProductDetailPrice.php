<?php

namespace App\Listeners;

use App\Events\PriceChange;
use App\Jobs\UpdatedProductDetailPrice;
use App\Models\ProductDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

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

    /**
     * Handle the event.
     */
    public function handle(PriceChange $event): void
    {
        UpdatedProductDetailPrice::dispatch($event->product->id, $event->user->id);
    }
}
