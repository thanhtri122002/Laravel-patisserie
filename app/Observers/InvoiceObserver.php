<?php

namespace App\Observers;

use App\Models\Invoice;
class InvoiceObserver
{
    public function creating(Invoice $invoice): void
    {
        $invoice->order_code = Invoice::generateOrderCode($invoice->user_id);
        $invoice->email = $invoice->user->email;
    }

}
