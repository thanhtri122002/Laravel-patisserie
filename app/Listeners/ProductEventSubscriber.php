<?php

namespace App\Listeners;


use App\Events\InvoiceCreated;
use App\Events\UpdateCartProductDetailStock;
use App\Jobs\HandleCancelInvoiceJob;
use App\Jobs\UpdateProductStock;
use App\Models\Invoice;
use Illuminate\Events\Dispatcher;

class ProductEventSubscriber
{

    public function handleInvoiceCreated(InvoiceCreated $event): void
    {
        $invoiceId = $event->invoice->id;
        $oldStatus = null;
        $newStatus = Invoice::PENDING;
        HandleCancelInvoiceJob::dispatch($invoiceId, $oldStatus, $newStatus);
    }

    public function handleUpdateProductStock(UpdateCartProductDetailStock $event)
    {
        $productId = $event->productDetail->product_id;
        $delta = $event->delta;
        UpdateProductStock::dispatch($productId, $delta);
    }

    public function handleDeleteItemFromCart() {}

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            InvoiceCreated::class,
            [ProductEventSubscriber::class, 'handleInvoiceCreated']
        );

        $events->listen(
            UpdateCartProductDetailStock::class,
            [ProductEventSubscriber::class, 'handleUpdateProductStock']
        );
    }
}
