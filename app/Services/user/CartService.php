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


    private function getOrCreateCart()
    {   
        $userId = $this->getUserId();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart)
        {
            $cart = Cart::create(['user_id' => $userId
                    ,'cost' => 0]);
            
        }

        return $cart;
 
    }

    public function addProduct($data)
    {
        $cart = $this->getOrCreateCart();
        $data['cart_id'] = $cart->id;
        $productDetail = $this->productDetailService->create($data);

        return $cart;
    }

    public function update($data, $id)
    {
        
    }

}