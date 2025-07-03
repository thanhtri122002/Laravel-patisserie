<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductFilterService extends Service {

    /**
     * Function to get the new product
     * 
     * @param int $limit 
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getNewProduct($limit): Collection
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

    public function getTheTopSellingProduct($limit)
    {
        return Product::join('product_details', 'products.id', 'product_details.id')
                    ->join('invoices', 'product_details.invoice_id', 'invoices.id')
                    ->where('invoices.status', Invoice::PAID)
                    ->selectRaw('SUM(product_details.quantity) as total_sold')
                    ->groupBy('products.id')
                    ->orderby('total_sold', 'desc')
                    ->limit($limit)
                    ->get();
    }

    public function getProductsBySearching($inputString)
    {   
        $pattern = '%' . $inputString . '%';
        return Product::where(function ($product)  use ($pattern) {

            $product->whereLike('name',$$pattern)
                    ->orWhereHas('category', function ($category) use ($pattern) {

                        $category->whereLike('name', $pattern);
                    });
        })->get();
    }

    public function getMostProfitableProduct($limit)
    {
        return Product::join('product_details', 'product.id', '=', 'product_details.product_id')
                        ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
                        ->where('invoices.status', Invoice::PAID)
                        ->selectRaw('SUM(product_details.cost) as total_profit')
                        ->groupBy('product.id')
                        ->orderByDesc('total_profit')
                        ->limit($limit)
                        ->get();
    }

    public function getCurrentMonthNewProduct()
    {
        $currentMonth = now()->month;

        return Product::whereMonth('created_at', $currentMonth)->get();

    }

    public function getOutOfStockProduct()
    {
        return Product::where('quantity', 0)->get();
    }

    
}