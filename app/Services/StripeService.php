<?php 
namespace App\Services;

use App\Models\Product;
use App\Models\User;
use Stripe\Customer;
use Stripe\Price;
use Stripe\Product as StripeProduct;
use Stripe\StripeClient;

class StripeService extends Service
{   
    protected $stripe;

    /**
     * Initialize the Stripe client globally 
     */
    public function  __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
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

            return [
                'stripe_product_id' => $product->stripe_product_id,
                'stripe_price_id' => $product->stripe_price_id,
            ];

        }  
    }
}