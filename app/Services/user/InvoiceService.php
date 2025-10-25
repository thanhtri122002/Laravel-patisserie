<?php

namespace App\Services\user;

use App\Events\InvoiceCreated;
use App\Models\Invoice;
use App\Models\ProductDetail;
use App\Services\Service;
use App\Services\StripeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
class InvoiceService extends Service
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    /**
     * Base query which will be used as base for more complicated queries
     * 
     * @return \Illuminate\Database\Eloquent\Builder<static>
     */
    protected function baseQuery()
    {
        return Invoice::with(['productDetails', 'user']);
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

    public function index($data, $perPage)
    {   
        return $this->baseQuery()
            ->when(isset($data['status']), function (Builder $query) use ($data) {
                $query->GetInvoiceWithStatus($data['status']);
            })
            ->paginate($perPage);
    }

    public function getUserInvoices($search, $perPage)
    {
        $userId = $this->getUser()->id;
        $query = Invoice::where('user_id', $userId);

        if ($search) {
            $query->where('status_code', 'LIKE', "%{$search}%");
        }

        return $query->paginate($perPage);
    }
    /**
     * A service updating the status of an invoice
     * 
     */
    public function updateInvoiceStatus($data)
    {
        $invoice = $this->detail($data['id']);
        $invoice->update([
            'status' => $data['status']
        ]);

        return $invoice;
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
    public function makeInvoice($data, $productsInCart): Invoice
    {
        $data['user_id'] = $this->getUser()->id;

        if (!$this->getUser()->stripe_id) {
            $this->stripe->createStripeCustomer($this->getUser());
        }

        $invoice = DB::transaction(function () use ($data, $productsInCart) {

            $invoice = Invoice::create($data);

            foreach ($productsInCart as $detail) {

                $detail->invoice_id = $invoice->id;
                $detail->save();
            }
            \Log::info('Invoice created', ['invoice_id' => $invoice->id]);

            InvoiceCreated::dispatch($invoice);
            return $invoice;
        });
        
        
        return $invoice;
    }
}
