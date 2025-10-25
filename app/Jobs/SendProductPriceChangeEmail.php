<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\User;
use App\Services\user\mail\MailToUserService;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class SendProductPriceChangeEmail implements ShouldQueue, ShouldBeUnique
{
    use Queueable, SerializesModels;

    public $userId;
    public $productId;
    /**
     * Create a new job instance.
     */
    public function __construct($userId, $productId)
    {
        $this->userId = $userId;
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     */
    public function handle(MailToUserService $service): void
    {   
        $product = Product::find('id', $this->productId);
        $user = User::find('id', $this->userId);
        $service->sendMailPriceUpdated($user, $product);
    }

    public function uniqueId(): string 
    {
        return (string) $this->userId;
    }
}
