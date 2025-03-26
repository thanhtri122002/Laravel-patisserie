<?php

namespace App\Observers;

use App\Events\InvoiceCreation;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceObserver
{   
    public function creating(Invoice $invoice): void
    {   
        DB::transaction(function () use($invoice) {
            $invoice->order_code = Invoice::generateOrderCode($invoice->user_id);
        });
    }
    /**
     * Handle the Invoice "created" event.
     */
    public function created(Invoice $invoice): void
    {

    }

    /**
     * Handle the Invoice "updated" event.
     */
    public function updated(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "deleted" event.
     */
    public function deleted(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "restored" event.
     */
    public function restored(Invoice $invoice): void
    {
        //
    }

    /**
     * Handle the Invoice "force deleted" event.
     */
    public function forceDeleted(Invoice $invoice): void
    {
        //
    }
}
