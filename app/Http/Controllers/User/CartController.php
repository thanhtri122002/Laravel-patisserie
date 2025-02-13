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

    public function addToCart(ProductDetailRequest $request)
    {
        $validate = $request->validated();
        $user = $this->getUser();
        $addProduct = CartService::getInstance()->withUser($user)->addProduct($validate);
        
    }

    public function update(ProductDetailRequest $request ,$productDetailId)
    {
        $user = $this->getUser();
        $data = $request->validated();
        $data = $request->safe()->only(['quantity']);
        $updateCart = CartService::getInstance()->withUser($user)->update($data, $productDetailId);

        return $updateCart;
    }

    public function delete()
    {

    }

}
