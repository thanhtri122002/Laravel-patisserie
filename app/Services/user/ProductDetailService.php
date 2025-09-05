<?php

namespace App\Services\user;

use App\Models\ProductDetail;
use App\Services\Service;
use Illuminate\Support\Facades\Log;

class ProductDetailService extends Service
{   
    /**
     * A function to get the ProductDetail instnace by id
     * 
     * @param int $id
     * 
     * @return \App\Models\ProductDetail
     */
    public function find($id): ProductDetail
    {
        return ProductDetail::findOrFail($id);
    }

    public function getAll()
    {
        return ProductDetail::all();
    }

    /**
     * A function create a ProductDetail instance
     * 
     * First it creates the ProductDetails instance with the data passed to the function
     * Then the function will calculate the total cost of the product detail and update the cost field
     * 
     * The expected keys in data array are:
     * - product_id (int)
     * - quantity (int)
     * - cart_id (int)
     * 
     * @param array $data the data of the product detail 
     * 
     * @return \App\Models\ProductDetail the created product detail            
     */
    public function create($data): ProductDetail
    {   
        Log::info($data);
        $productDetail =  ProductDetail::create($data);
        $cost = $productDetail->calculateTotal();
        
        $productDetail->update(['cost' => $cost]);
        
        
        return $productDetail;
    }
    /**
     * this operation use to update the product detail
     *
     * The function update the quantity and the cost of the product detail
     * The expected keys in the data array are:
     * - quantity: the number of the product detail based on the mode
     * - mode: relative for the minus plus operation on the productDetail's current quantity, 
     *         absolute mode for replacing the current quantity with the new quantity
     * 
     * @param array $data the data that is necessary for updating a productDetail instance
     * @param object $productDetail the product detail to update
     * 
     * @return \App\Models\ProductDetail the updated product detail
     */
    public function update($data, $productDetail): ProductDetail
    {   
        if ($data['mode'] === 'relative') {
            $productDetail->quantity += $data['quantity'];
            if ($productDetail->quantity === 0) {
                $productDetail->delete();
                
                return $productDetail;
            }

        } elseif ($data['mode'] === 'absolute') {
            $productDetail->quantity = $data['quantity'];
        }
        
        $cost = $productDetail->calculateTotal();

        $productDetail->update([
            'quantity' => $productDetail->quantity,
            'cost' => $cost
        ]);

        return $productDetail;
    }

    /**
     * Delete the product detail
     *
     * @param object $productDetail the product detail to delete
     * 
     * @return bool true if the product detail is deleted, false otherwise
     */
    public function delete($productDetail): bool
    {
        $productDetail->delete();

        return true;
    }

    public function setDiscount($productId, $amount)
    {
        
    }

}