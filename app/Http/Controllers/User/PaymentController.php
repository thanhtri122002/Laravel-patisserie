<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use App\Services\user\InvoiceService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{   
    protected $invoiceService;

    protected $stripeService;
    //
    public function __construct(InvoiceService $invoiceService, StripeService $stripeService)
    {
        $this->invoiceService = $invoiceService;
        $this->stripeService = $stripeService;
    }

    public function getUser()
    {
        return $this->guard()->user();
    }

    public function checkout($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);
        $checkoutUrl = $this->stripeService->withUser($user)->checkoutSession($invoice);

        return response()->json([
            'message' => 'checkout session created successfully',
            'url' => $checkoutUrl,
        ]);
    }
}
