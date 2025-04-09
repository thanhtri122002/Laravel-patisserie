<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use App\Services\user\InvoiceService;
use Illuminate\Http\Request;

class PaymentController extends BaseController
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

    public function embeddedCheckout($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);

        $clientSecret = $this->stripeService->withUser($user)->embededCheckOutForm($invoice);
        
        return response()->json(['clientSecret' => $clientSecret]);
    }

    public function retrieveStatus(Request $request)
    {
        $user = $this->getUser();
        $sessionId = $request->input('sessionId');
        dd($sessionId);
        
        $status = $this->stripeService->withUser($user)->retrieveStatus($sessionId);

        return $status;
    }
}
