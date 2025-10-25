<?php

namespace App\Events;

use App\Models\Invoice;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvoiceCreated implements ShouldDispatchAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $invoice;
    /**
     * Create a new event instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

}
