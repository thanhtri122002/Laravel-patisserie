<?php

namespace App\Services\user;

use App\Models\ProductDetail;
use App\Services\Service;

class ProductDetailService extends Service
{   
    
    public function find($id)
    {
        return ProductDetail::findOrFail($id);
    }

    public function getAll()
    {
        return ProductDetail::all();
    }

    public function create($data)
    {   
        
        $productDetail =  ProductDetail::create($data);
        $cost = $productDetail->calculateTotal();
        
        
        $productDetail->update(['cost' => $cost]);
        
        
        return $productDetail;
    }
    /**
     * this operation use to update the product detail
     * a product detail can only update the quantity in the cart and adding the invoices id 
     *  
     */
    public function update($quantity, $productDetail)
    {
        $productDetail->update(['quantity' => $quantity]);
        $cost = $productDetail->calculateTotal();
        $productDetail->update(['cost' => $cost]);

        return $productDetail;
    }

    public function delete($productDetail)
    {
        $productDetail->delete();

        return true;
    }

}