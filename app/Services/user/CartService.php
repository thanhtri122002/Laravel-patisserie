<?php

namespace App\Services\user;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\Service;

class CartService extends Service 
{   
    protected $productDetailService ;

    public function __construct(ProductDetailService $productDetailService)
    {   
        $this->productDetailService = $productDetailService;
    }

    private function getProduct($id)
    {

        return Product::findOrFail($id);
    }

    private function getUserId()
    {
        return $this->getUser()->id;
    }

    /**
     * Get the cart if the user already has a cart, if not create the cart for the user 
     */
    private function getOrCreateCart()
    {   
        $userId = $this->getUserId();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            $cart = Cart::create([
                    'user_id' => $userId
                    ,'cost' => 0]);
        }

        return $cart;
 
    }
    /**
     * Add the product into the cart
     * 
     */
    public function addProduct($data)
    {
        $cart = $this->getOrCreateCart();
        $data['cart_id'] = $cart->id;

        $productDetail = ProductDetail::where('product_id', $data['product_id'])->first();

        if(!$productDetail){
            $productDetail = $this->productDetailService->create($data);
        }
        elseif ($productDetail){
            $productDetail->update(['quantity' => $productDetail->quantity + $data['quantity']]);

        }

        return $cart;
    }
    /**
     * Cart update , mainly update when the product detail, including the 
     */
    public function update($data, $productDetailId)
    {
        $cart = $this->getOrCreateCart();
        $productDetail = $this->productDetailService->update($productDetailId, $data);
        
        return $cart;
    }

    public function delete()
    {
        $cart = $this->getOrCreateCart();
        $cart->delete();
        
        return true;
    }

    /**
     * Note if the product id of the cart is does not have the invoice id then you can delete the product id too 
     * You can choose which product detail can be have the invoice id 
     * 
     */

}