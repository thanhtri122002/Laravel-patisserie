<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\AddToCartRequest;
use App\Http\Requests\user\ProductDetailRequest;
use App\Services\user\CartService;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    
    public function getUser()
    {
        return $this->guard()->user();
    }

    public function get(Request $request)
    {
        $user = $this->getUser();
        
    }

    public function getCart()
    {
        $user = $this->getUser();
        $cart = CartService::getInstance()->withUser($user)->getOrCreateCart();
        
        return $cart;
    }

    public function addToCart(ProductDetailRequest $request)
    {
        $data = $request->safe()->only(['product_id', 'name', 'quantity']);
        $user = $this->getUser();
        $addProduct = CartService::getInstance()->withUser($user)->addProduct($data);
        
        return $addProduct;
    }

    public function update(ProductDetailRequest $request ,$productDetailId)
    {
        $user = $this->getUser();
        $data = $request->safe()->only(['quantity']);
        $updateProduct = CartService::getInstance()->withUser($user)->update($data, $productDetailId);

        return $updateProduct;
    }

    public function deleteProduct($productDetailId)
    {
        $user = $this->getUser();
        CartService::getInstance()->withUser($user)->deleteProduct($productDetailId);
        
        return true;
    }

}
