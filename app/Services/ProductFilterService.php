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
        return Product::with('productImages')
                    ->orderBy('created_at', 'desc')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Return all the products having price below the $priceLimit
     * 
     * @param float $priceLimt
     * @param string $order 
     * 
     * @return \Illuminate\Database\Eloquent\Collection   
     */
    public function getProductsInPriceRange($priceLimit, $order = 'asc') 
    {
        return Product::where('price' , '>', $priceLimit)
                    ->orderBy('price', $order)
                    ->get();
    }
    /**
     * Retrieve the top selling products
     * 
     * Return the products that have 
     * 
     * @param int $limit 
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function getTheTopSellingProduct($limit)
    {   
        return Product::with("productImages")
                    ->join('product_details', 'products.id', '=', 'product_details.product_id')
                    ->join('invoices', 'product_details.invoice_id', 'invoices.id')
                    ->where('invoices.status', Invoice::PAID)
                    ->select(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.description'
                    )
                    ->selectRaw('SUM(product_details.quantity) as total_sold')
                    ->groupBy(
                        'products.id',
                        'products.name',
                        'products.price',
                        'products.description'
                    )
                    ->orderby('total_sold', 'desc')
                    ->limit($limit)
                    ->get();
    }

    public function getProductsBySearching($inputString)
    {   
        $pattern = '%' . $inputString . '%';

        return Product::where(function ($product)  use ($pattern) {

            $product->whereLike('name', $pattern)
                    ->orWhereHas('category', function ($category) use ($pattern) {

                        $category->whereLike('name', $pattern);
                    });
        })->get();
    }

    public function getMostProfitableProduct($limit)
    {
    return Product::with("productImages")
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
        ->where('invoices.status', Invoice::PAID)
        ->select(
            'products.id',
            'products.name',
            'products.description'
        )
        ->selectRaw('SUM(product_details.cost) as total_profit')
        ->groupBy(
            'products.id',
            'products.name',
            'products.description'
        )
        ->orderByDesc('total_profit')
        ->limit((int) $limit)
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

    public function getDisCountProduct()
    {
        return Product::where('discount', '>', 0.0)->get();
    }
}