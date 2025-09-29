<?php

namespace App\Jobs;

use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdateProductStockJob implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Queueable;
    public $invoiceId;
    public $oldStatus;
    public $newStatus;
    /**
     * Create a new job instance.
     */
    public function __construct($invoiceId, $oldStatus, $newStatus)
    {
        $this->invoiceId = $invoiceId;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   
        DB::transaction(function () {
            $invoice = Invoice::with(['productDetails.product' => function ($query) {
                $query->lockForUpdate();
            }])->findOrFail($this->invoiceId);

            foreach ($invoice->productDetails as $detail){
                $product = $detail->product;
                $quantity = $detail->quantity;
                if ($this->oldStatus != Invoice::PENDING && $this->newStatus == Invoice::PENDING) {
                    $product->decrement('stock', $quantity);
                }
        
                if ($this->oldStatus != Invoice::CANCELLED && $this->newStatus == Invoice::CANCELLED) {
                    $product->increment('stock', $quantity);
                }
            }  
        });
    }

    public function uniqueId(): string 
    {
        return (string) $this->invoiceId;
    }
}
