<?php

namespace App\Listeners;

use App\Events\InvoiceCreated;
use App\Events\InvoiceStatusChanged;
use App\Jobs\UpdateProductStockJob;
use Illuminate\Events\Dispatcher;

class UpdateProductStockSubscriber {

    public function handleInvoiceStatusChanged(InvoiceStatusChanged $event)
    {
        $invoice = $event->invoice;
        $newStatus = $invoice->status;
        $oldStatus = $invoice->getOriginal('status');
        UpdateProductStockJob::dispatch($invoice->id, $oldStatus, $newStatus);
    }

    public function handleOrderPlaced(InvoiceCreated $event)
    {
        $invoice = $event->invoice;
        $newStatus = $invoice->status;
        $oldStatus = $invoice->getOriginal('status');
        UpdateProductStockJob::dispatch($invoice->id, $oldStatus, $newStatus);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            InvoiceStatusChanged::class,
            [UpdateProductStockSubscriber::class, 'handleInvoiceStatusChanged']
        );

        $events->listen(
            InvoiceCreated::class,
            [UpdateProductStockSubscriber::class, 'handleInvoiceCreated']
        );
    }
}