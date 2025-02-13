<?php

namespace App\Services\user;

use App\Models\ProductDetail;
use App\Services\Service;

class ProductDetailService extends Service
{


    public function create($data)
    {
        $productDetail =  ProductDetail::create($data);
        $cost = $this->calculateCost($productDetail);
        $productDetail->update(['cost' => $cost]);
        
        return $productDetail;
    }

    public function update($id, $data)
    {
        $productDetail = $this->find($id);
        $productDetail->update($data);

        return $productDetail;
    }

    public function delete($id)
    {
        $productDetail = $this->find($id);
        $productDetail->delete();

        return true;
    }

    public function find($id)
    {
        return ProductDetail::findOrFail($id);
    }

    public function getAll()
    {
        return ProductDetail::all();
    }

    public function calculateCost($productDetail)
    {
        return $productDetail->product->price * $productDetail->quantity;
    }

}