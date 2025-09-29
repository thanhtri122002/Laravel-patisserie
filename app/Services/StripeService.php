<?php 
namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Stripe\Customer;
use Stripe\StripeClient;

class StripeService extends Service
{   
    protected $stripe;

    /**
     * Initialize the Stripe client globally 
     */
    public function  __construct()
    {
        $this->stripe = new StripeClient([
            'api_key'=> config('services.stripe.secret'),
            "stripe_version" => "2025-08-27.basil"    
        ]);
    }

    /**
     * Create the stripe customer when the user submit their product cart
     * @param User
     * @return Customer
     */
    public function createStripeCustomer(User $user): Customer
    {
        $customer = $this->stripe->customers->create([
            'name' => $user->name,
            'email' => $user->email,
        ]);
        $user->update(['stripe_id' => $customer->id]);
        
        return $customer;
    }

    public function getBalance(User $user)
    {
        $customer = $this->stripe->customers->retrieve($user->stripe_id);
        return $customer->balance;
    }
    
    /**
     * Create the product and price for stripe api
     * @param Product $product
     * @return array 
     * 
     */
    public function createStripeProduct(Product $product): array
    {      
        
        if(!$product->stripe_product_id && !$product->stripe_price_id) {

            $stripeProduct = $this->stripe->products->create([

                'name' => $product->name,
            ]);
            $stripePrice = $this->stripe->prices->create([

                'unit_amount' => intval($product->price),
                'currency' => 'vnd',
                'product' => $stripeProduct->id
            ]);

            $product->withoutEvents(function () use($product, $stripeProduct, $stripePrice) {
                $product->update([
                    'stripe_product_id' => $stripeProduct->id,
                    'stripe_price_id' => $stripePrice->id,
                ]);
            });
        }  
        
        return [
            'stripe_product_id' => $product->stripe_product_id,
            'stripe_price_id' => $product->stripe_price_id,
        ];
    }

    public function updateStripeProduct(Product $product)
    {   
        if ($product->isDirty('name')) {
            $this->stripe->products->update($product->stripe_product_id, [
                'name' => $product->name,
            ]);
        }

        if ($product->isDirty('price')) {
            $this->stripe->prices->update($product->stripe_price_id, [
                'active' => false,
            ]);
            $newStripePrice = $this->stripe->prices->create([
                'unit_amount' => $product->price,
                'currency' => 'vnd',
                'product' => $product->stripe_product_id,
            ]);
            $product->withoutEvents(function () use($newStripePrice, $product) {
                $product->forceFill(['stripe_price_id' => $newStripePrice->id])->saveQuietly();
            });
        }
    }

    public function archiveProduct(Product $product)
    {
        $this->stripe->products->update($product->stripe_product_id, [
            'active' => false,
        ]);
    }

    public function removeProduct(Product $product)
    {
        // Get all prices for this product
        $prices = $this->stripe->prices->all([
            'product' => $product->stripe_product_id
        ]);

        // Deactivate all prices
        foreach ($prices->data as $price) {
            $this->stripe->prices->update($price->id, ['active' => false]);
        }

        // Archive the product
        $this->stripe->products->update($product->stripe_product_id, ['active' => false]);
    }

    /**
     * Return a line items represent 
     */
    public function getLineItems(Invoice $invoice)
    {
        $invoiceDetails = $invoice->productDetails;
        
        $lineItem = [];
        foreach($invoiceDetails as $detail) {
            
            $lineItem[] = [
                'price' => $detail->product->stripe_price_id,
                'quantity' => $detail->quantity,
            ];
        }

        return $lineItem;
    }

    public function checkoutSession(Invoice $invoice) 
    {   
        $lineItem = $this->getLineItems($invoice);
        $checkoutSession = $this->stripe->checkout->sessions->create([
            'ui_mode' => 'custom',
            'line_items' => $lineItem,
            'phone_number_collection' => [
                'enabled' => true,
            ],
            'customer_email' => $this->getUser()->email,
            'billing_address_collection' => 'required',
            'mode' => 'payment',
            'metadata' => [
                'invoice_id' => $invoice->id
            ],
            'return_url' => url('/user/checkoutSession/complete') . '?session_id={CHECKOUT_SESSION_ID}',
        ]);
        
        return $checkoutSession->client_secret;
    }

    public function retrieveSessionStatus($session_id) {
        $session = $this->stripe->checkout->sessions->retrieve($session_id, ['expand' => ['payment_intent']]);
        $lineItems = $this->stripe->checkout->sessions->allLineItems($session_id)->data;
        return [
            'status' => $session->status,
            'payment_status' => $session->payment_status,
            'payment_intent_id' => $session->payment_intent->id,
            'payment_intent_status' => $session->payment_intent->status,
            'items' => $lineItems,
            'invoiceId' => $session->metadata->invoice_id
        ];
    }
}