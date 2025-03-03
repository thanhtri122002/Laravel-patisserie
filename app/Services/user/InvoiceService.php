<?php

namespace App\Services\user;

use App\Models\Invoice;
use App\Models\ProductDetail;
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

    public function getInvoiceProducts($id)
    {
        $invoice = $this->detail($id);
        
        return $invoice->productDetails;
    }

    public function list($search, $perPage)
    {
        $userId = $this->getUser()->id;
        $query = Invoice::where('user_id', $userId);

        if ($search) {
            $query->where('status_code', 'LIKE', "%{$search}%");
        }

        return $query->paginate($perPage);
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