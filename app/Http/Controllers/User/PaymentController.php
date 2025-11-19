<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Services\user\InvoiceService;
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

    public function checkoutSession($id)
    {
        $user = $this->getUser();
        $invoice = $this->invoiceService->withUser($user)->detail($id);
        
        $clientSecret = $this->stripeService->withUser($user)->checkoutSession($invoice);
        
        return response()->json(['clientSecret' => $clientSecret]);
    }

    public function retrieveStatus(Request $request)
    {
        $user = $this->getUser();
        $session_id = $request->input('session_id');
        $status = $this->stripeService->withUser($user)->retrieveSessionStatus($session_id);

        return $status;
    }
}
