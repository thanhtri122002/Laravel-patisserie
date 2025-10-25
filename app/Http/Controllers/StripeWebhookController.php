<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateProductStockJob;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        try {
            $payload = $request->getContent();
            $sigHeader = $request->header('Stripe-Signature');
            $secret = config('services.stripe.webhook_secret');
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $checkout = $event->data->object;
                $invoiceId = $checkout->metadata->invoice_id ?? null;

                if ($invoiceId) {
                    $invoice = Invoice::find($invoiceId);

                    if ($invoice && $invoice->status !== Invoice::PAID) {
                        $oldStatus = $invoice->status;

                        $invoice->update(['status' => Invoice::PAID]);

                        \Log::info('Stripe webhook handled invoice', [
                            'invoiceId' => $invoiceId,
                            'oldStatus' => $oldStatus,
                            'newStatus' => Invoice::PAID,
                        ]);

                        UpdateProductStockJob::dispatch($invoiceId, $oldStatus, Invoice::PAID);
                    }
                }
                break;

            default:
                \Log::info('Unhandled Stripe event', ['type' => $event->type]);
        }

        return response('Webhook handled', 200);
    }
}
