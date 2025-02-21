<?php

namespace App\Services\user;

use App\Models\Invoice;
use App\Services\Service;
use App\Services\StripeService;
use Illuminate\Support\Facades\DB;

class InvoiceService extends Service
{   
    protected $stripe;
    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function detail($id)
    {
        return Invoice::with('productDetails')->findOrFail($id);
    }

    /**
     * 
     */
    public function makeInvoice($data, $productsInCart)
    {   
        $data['user_id'] = $this->getUser()->id;

        if(!$this->getUser()->stripe_id) {
            $this->stripe->createStripeCustomer($this->getUser());

        }
        
        $invoice = DB::transaction(function() use ($data, $productsInCart) {
            
            $invoice = Invoice::create($data);
    
            foreach($productsInCart as $detail) {
                $detail->invoice_id = $invoice->id;
                $detail->save();
            }
            return $invoice;
        });

        return $invoice;
       
    }


}