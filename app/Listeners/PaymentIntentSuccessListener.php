<?php

namespace App\Listeners;

use App\Events\PaymentIntentSuccessEvent;
use App\Models\Invoice;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Support\Facades\DB;

class PaymentIntentSuccessListener implements ShouldDispatchAfterCommit
{
    public function handle(PaymentIntentSuccessEvent $event)
    {
        DB::transaction(function () use ($event) {

            $invoice = Invoice::lockForUpdate()->findOrFail($event->invoiceId);

            if ($invoice->status !== Invoice::PAID) {
                $invoice->update(['status' => Invoice::PAID]);

                foreach ($invoice->productDetails as $detail) {
                    $detail->update(['cart_id' => null]);
                }
            }
        });
    }
}
