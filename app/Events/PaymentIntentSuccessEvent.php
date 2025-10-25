<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentIntentSuccessEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $status;
    public $invoiceId;
    /**
     * Create a new event instance.
     */
    public function __construct($status, $invoiceId)
    {
        $this->status = $status;
        $this->invoiceId = $invoiceId;
    }

}
