<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\user\AddToCartRequest;
use App\Http\Requests\user\ProductDetailRequest;
use App\Http\Requests\user\submitCartRequest;
use App\Services\user\CartService;
use Illuminate\Support\Facades\Log;

class CartController extends BaseController
{
    /**
     * A function to get the current authenticated user
     *
     * @return Illuminate\Contracts\Auth\Guard::user
     */
    public function getUser()
    {
        return $this->guard()->user();
    }

    /**
     * A function to get the cart of a specific user 
     * 
     * This method get the current authenticated user and the call the CartService 
     * to retrieve the cart which contains all the ProductDetail instance of that cart
     * 
     * @return @return Illuminate\Database\Eloquent\Collection|\App\Models\productDetail[]
     */
    public function getCart()
    {      
        $user = $this->getUser();
        $cart = CartService::getInstance()->withUser($user)->cartDetail();
        
        return $cart;
    }

    /**
     * A function to add a ProductDetail into the cart
     * 
     * This method get the current authenticated user and the call the CartService 
     * to add a ProductDetail into the cart 
     * 
     * @param App\Http\Requests\user\ProductDetailRequest $request
     * 
     * @return \App\Models\ProductDetail
     */
    public function addToCart(ProductDetailRequest $request)
    {   
       
        $data = $request->safe()->only(['product_id', 'quantity', 'mode']);
        $user = $this->getUser();
        Log::info($data);
        $addProduct = CartService::getInstance()->withUser($user)->addProduct($data);
        
        return $addProduct;
    }

    /**
     * A function to update a ProductDetail instance
     * 
     * This will update the quantity of an existing ProductDetail 
     * 
     * @param App\Http\Requests\user\ProductDetailRequest $request
     * @param int $productDetailId
     * 
     * @return \App\Models\ProductDetail
     */
    public function update(ProductDetailRequest $request ,$productDetailId)
    {   
        $user = $this->getUser();
        $data = $request->safe()->only(['quantity', 'mode']);
        $updateProduct = CartService::getInstance()->withUser($user)->update($data, $productDetailId);

        return $updateProduct;
    }

    /**
     * A function to submit the cart which will turn the cart into an invoice
     * 
     * First this will receive the submitCartRequest which contain personal in4
     * then call the cartService to create an invoice
     * 
     * @param App\Http\Requests\user\submitCartRequest $request
     * 
     * @return boolean
     */
    public function submitCart(submitCartRequest $request)
    {
        $user = $this->getUser();
        $data = $request->validated();
        $submitCart = CartService::getInstance()->withUser($user)->submitCart($data);        

        return true;
    }

    /**
     * This function delete a product from the cart
     * 
     * @param int $productDetailId
     * 
     * @return boolean
     */
    public function deleteProduct($productDetailId)
    {
        $user = $this->getUser();
        CartService::getInstance()->withUser($user)->deleteProduct($productDetailId);
        
        return true;
    }
}
