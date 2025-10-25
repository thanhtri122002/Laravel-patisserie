<?php

namespace App\Jobs;

use App\Mail\SendPriceUpdatedMail;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Services\user\InvoiceService;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class UpdatedProductDetailPrice implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Queueable;

    public $productId;
    public $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($productId, $userId)
    {
        $this->productId = $productId;
        $this->userId = $userId;
    }

    private function getUnpaidProductDetail()
    {
        return ProductDetail::where('product_id', $this->productId)
            ->where(function ($q) {
                $q->whereHas('invoice', function ($query) {
                    $query->where('status', '!=', Invoice::PAID);
                })->orWhereNull('invoice_id');
            })
            ->lockForUpdate()
            ->get();
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $unpaidProductDetails = $this->getUnpaidProductDetail();
            foreach ($unpaidProductDetails as $detail) {
                $detail->update([
                    'cost' => $detail->calculateTotal(),
                ]);
            }
        });
        SendProductPriceChangeEmail::dispatch($this->userId, $this->productId);

    }

    public function uniqueId(): string
    {
        return (string) $this->productId;
    }
}
