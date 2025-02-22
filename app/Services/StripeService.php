<?php 
namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Laravel\Cashier\Cashier;
use Stripe\Customer;
use Stripe\Price;
use Stripe\Product as StripeProduct;
use Stripe\Service\InvoiceService;
use Stripe\StripeClient;

class StripeService extends Service
{   
    protected $stripe;
    protected $invoice;

    /**
     * Initialize the Stripe client globally 
     */
    public function  __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
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
        if(!$product->stripe_product_id || !$product->stripe_price_id) {

            $stripeProduct = $this->stripe->products->create([

                'name' => $product->name,
            ]);

            $stripePrice = $this->stripe->prices->create([

                'unit_amount' => $product->price * 100,
                'currency' => 'vnd',
                'product' => $stripeProduct->id
            ]);

            $product->update([
                'stripe_product_id' => $stripeProduct->id,
                'stripe_price_id' => $stripePrice->id,
            ]);

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
                'unit_amount' => $product->price * 100,
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
                'price_data' => [
                    'price' => $detail->product->stripe_price_id,
                    'currency' => 'vnd',
                    'product_data' => [
                        'name' => $detail->name,
                    ],
                    'unit_amount' => $detail->product->price,
                    'quantity' => $detail->quantity
                ],
            ];
        }

        return $lineItem;
    }

    public function checkoutIntent()
    {

    }
    
}