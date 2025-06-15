<?php

namespace App\Services\user;

use App\Models\ProductDetail;
use App\Services\Service;

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
        
        $productDetail =  ProductDetail::create($data);
        $cost = $productDetail->calculateTotal();
        
        $productDetail->update(['cost' => $cost]);
        
        
        return $productDetail;
    }
    /**
     * this operation use to update the product detail
     *
     * The function update the quantity and the cost of the product detail
     * 
     * @param int $quantity the amount added or subtract from the product detail
     * @param object $productDetail the product detail to update
     * 
     * @return \App\Models\ProductDetail the updated product detail
     */
    public function update($quantity, $productDetail): ProductDetail
    {
        $productDetail->quantity += $quantity;
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

}