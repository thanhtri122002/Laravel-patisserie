<?php

namespace App\Services\Admin;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductReadService
{
    protected function baseQuery()
    {
        return Product::with(['category', 'productImages']);
    }

    public function getNewProduct($limit)
    {
        return Product::orderBy('created_at', 'desc')
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
        return Product::where('price', '<', $priceLimit)
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
    public function getTopSelling($limit)
    {
        return Product::join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->leftJoin('product_images', 'products.id', '=', 'product_images.product_id')
            ->where('invoices.status', Invoice::PAID)
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                DB::raw('MIN(product_images.url) as first_image')
            )
            ->selectRaw('SUM(product_details.quantity) as total_sold')
            ->groupBy(
                'products.id',
                'products.name',
                'products.price',
                'products.description'
            )
            ->orderBy('total_sold', 'desc')
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
    public function getMostProfitableProducts($limit)
    {
        return $this->baseQuery()->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('invoices', 'product_details.invoice_id', '=', 'invoices.id')
            ->where('invoices.status', Invoice::PAID)
            ->select('products.name', 'products.description')
            ->selectRaw('SUM(product_details.cost) as total_profit')
            ->groupBy('products.name', 'products.description')
            ->orderByDesc('total_profit')
            ->limit($limit)
            ->get();
    }
}
