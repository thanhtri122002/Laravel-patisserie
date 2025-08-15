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

    /**
     * Get the Invoice based on the invoide id
     * 
     * @param int $id
     * 
     * @return App\Models\Invoice
     */
    public function detail(int $id)
    {   
        return Invoice::with('productDetails')->findOrFail($id);
    }

    /**
     * Get the products in the invoice based on the id of the invoice
     * Note: 
     *  
     * @param int $id
     * 
     * @return Collection<int, \App\Models\ProductDetail>
     */
    public function getInvoiceProducts(int $id)
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
     * Create the unpaid invoice for the submitted cart
     * Linked the products details to the newly created invoice
     * 
     * @param array @data
     * @param array $productsInCart
     * 
     * @return App\Models\Invoice
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
                $detail->cart_id = null;
                $detail->save();
            }

            return $invoice;
        });

        return $invoice;
    }

    
}