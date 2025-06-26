<?php
namespace App\Services\user;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Services\Service;

class CartService extends Service 
{   
    /**
     * @var \App\Services\user\ProductDetailService
     */
    protected $productDetailService ;
    
    /**
     * @var App\Services\user\InvoiceService
     */
    protected $invoiceService;

    public function __construct(ProductDetailService $productDetailService)
    {   
        $this->productDetailService = $productDetailService;
    }

    /**
     * A function to get the current authenticated user's id
     * 
     * @return int the current authenticated user's id
     */
    private function getUserId()
    {
        return $this->getUser()->id;
    }

    /**
     * Get the cart for the user
     * if the user already has a cart
     * if not create the cart for the user 
     * 
     * @return \App\Models\Cart
     */
    public function getOrCreateCart()
    {   
        $userId = $this->getUserId();
        
        $cart = Cart::where('user_id', $userId)->first();
        
        if (!$cart) {
            $cart = Cart::create([
                        'user_id' => $userId
                        ,'cost' => 0
                    ]);
        }

        return $cart;
 
    }
    /**
     * Get a productDetail
     * 
     * First the function will the the cart of the user and then find the productDetail
     * by id
     * 
     * @param int $productDetail 
     * @return \App\Models\ProductDetail
     */
    public function getProductDetail($productDetailId)
    {
        $cart = $this->getOrCreateCart();
        $productDetail = $cart->productDetail()->findOrFail($productDetailId);

        return $productDetail;
    }

    /**
     * Get all the product details in the cart
     * 
     * First it checks whether the cart exists for a particular user
     * if it does, the function returns the cart
     * if it does not, create a new cart for the user
     * 
     * @return Illuminate\Database\Eloquent\Collection|\App\Models\productDetail[] A Collection containing ProductDetail objects.
     */
    public function cartDetail()
    {
        $cart = $this->getOrCreateCart();
        
        return $cart->productDetails;
    }
    /**
     * Add the product into the cart
     * 
     * this method checks whether a product detail already exist in the cart
     * if it does, it increments the quantity
     * if it does no, it creastes a new product detail associated with the cart
     * 
     * @param array $data: the data containing atleast 
     *                              - product_id: int, required
     *                              - cart_id: int, required 
     * 
     * @return \App\Models\ProductDetail The created or updated ProductDetail instance
     */
    public function addProduct($data)
    {
        $cart = $this->getOrCreateCart();
        $data['cart_id'] = $cart->id;
        $data['mode'] = 'relative';

        $productDetail = ProductDetail::where('product_id', $data['product_id'])->first();
        
        if(!$productDetail){
            $productDetail = $this->productDetailService->create($data); 
        }
        elseif ($productDetail){
            $productDetail = $this->productDetailService->update($data, $productDetail);

        }

        return $productDetail;
    }

    /**
     * Submit the cart to create the invoice for the user
     * 
     * First get all the productDetails in the cart then calculate the total cost of the cart
     * then create the invoice instance for the cart
     * 
     * The expected keys in the $data array are:
     *  - phone_number: string
     *  - address: string
     *  - email: string
     * 
     * @param array $data: the data containing 
     *                    
     * @return \App\Models\Invoice
     */
    public function submitCart($data)
    {   
        
        $productInCart = $this->cartDetail();
        $user = $this->getUser();
        $data['cost'] = $this->getCartCost();
        $invoice = InvoiceService::getInstance()->withUser($user)->makeInvoice($data, $productInCart);
        
        return $invoice;
    }
    /**
     * Cart update , mainly update when the product detail, including the 
     * 
     * @param array $data a data array containing
     *                          - quantity: int
     *                          - mode: relative or absolute, 
     *                              1/ relative means the data will minus or plus the quantity
     *                              2/ absolute means directly set the quantity 
     * @param int $productDetailId
     * @return \App\Models\ProductDetail
     */
    public function update($data, $productDetailId)
    {   
        $productDetail = $this->getProductDetail($productDetailId);
        $productDetail = $this->productDetailService->update($data, $productDetail);
        
        return $productDetail;
    }

    /**
     * A function to clear all the product in the cart
     * 
     * @return boolean
     */
    public function clearCart()
    {
        $productsInCart = $this->cartDetail();
        foreach($productsInCart as $detail) {
            $detail->delete();
        }
        
        return true;
    }

    /**
     * A function to delete a product in the cart
     * 
     * First get the productDetail by the id and then delete it 
     * 
     * @param int $productDetailId 
     * @return boolean 
     */
    public function deleteProduct($productDetailId)
    {
        $productDetail = $this->getProductDetail($productDetailId);
        $this->productDetailService->delete($productDetail);
        
        return true;
    }

    /**
     * A function to get the total price of the cart
     * 
     * First get the cart of the current user then get all the products in the cart
     * then calculate the cost of the cart
     * 
     * @return float $cost total cost of all product in the cart
     */
    public function getCartCost()
    {
        $cart = $this->getOrCreateCart();
        
        $productDetails = $cart->productDetails;
        $cost = 0;

        foreach($productDetails as $detail) {
            $cost = $detail->calculateTotal();
        }

        return $cost;
    }

    /**
     * Note 
     * 1/   if the product id of the cart is does not have the invoice id 
     *      then you can delete the product id too 
     *      You can choose which product detail can be have the invoice id 
     * 
     */
}