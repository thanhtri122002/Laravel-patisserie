<?php
namespace App\Jobs;

use App\Events\ProductStockUpdated;
use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class HandleCancelInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public $invoiceId;
    public $oldStatus;
    public $newStatus;

    public function __construct($invoiceId, $oldStatus, $newStatus)
    {
        $this->invoiceId = $invoiceId;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function handle(): void
    {
        $updatedProducts = [];

        DB::transaction(function () use ($updatedProducts) {
            $invoice = Invoice::with(['productDetails.product'])
                ->lockForUpdate()
                ->findOrFail($this->invoiceId);

            foreach ($invoice->productDetails as $detail) {
                $product = $detail->product;
                $quantity = $detail->quantity;

                if ($this->oldStatus !== Invoice::CANCELLED && $this->oldStatus !== Invoice::PAID && $this->newStatus === Invoice::CANCELLED) {
                    \Log::info("Incrementing stock for product {$product->id}");
                    $product->increment('stock', $quantity);
                }

                $product->refresh();
                $updatedProducts[] = [
                    'name' => $product->name,
                    'stock' => $product->stock,
                ];
            }
        });

        foreach ($updatedProducts as $product) {
            broadcast(new ProductStockUpdated($product['name'], $product['stock']));
        }

    }
}
