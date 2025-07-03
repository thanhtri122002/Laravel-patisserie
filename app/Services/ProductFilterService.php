<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;

class ProductFilterService extends Service {

    public function getNewProduct($limit) 
    {
        return Product::orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get();
    }

    public function getProductsInPriceRange($priceLimit, $order = 'asc') 
    {
        return Product::where('price' , '>', $priceLimit)
                    ->orderBy('price', $order)
                    ->get();
    }

    public function getTheTopSellingProduct($limit, )
    {
        return Product::join('product_details', 'products.id', 'product_details.id')
                    ->join('invoice', 'product_details.invoice_id', 'invoice.id')
                    ->where('invoice.status', Invoice::PAID)
                    ->selectRaw('SUM(product_details.quantity) as total_sold')
                    ->groupBy('products.id')
                    ->orderby('total_sold', 'desc')
                    ->limit($limit)
                    ->get();
    }
}