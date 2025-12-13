<?php

namespace App\Services\admin\AdminDashboard;

use App\Models\Category;
use App\Models\Product;
use App\Services\Service;

class CategoryStatService extends Service {

    public function getHaveMostProducts ($limit)
    {
        return Product::join("categories", 'products.category_id', '=', 'categories.id')
                        ->select('categories.id', 'categories.name')
                        ->selectRaw("COUNT(products.id) as total_products")
                        ->groupBy('categories.id', 'categories.name')
                        ->orderBy('total_products', 'desc')
                        ->limit($limit)
                        ->get();
    }

    public function getMostProfit ($limit) 
    {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
                        ->join('product_details', 'products.id', '=', 'product_details.product_id')
                        ->select('categories.name', 'categories.id')
                        ->selectRaw('SUM(product_details.cost) as income')
                        ->groupBy('categories.name', 'categories.id')
                        ->orderBy('income', 'desc')
                        ->limit($limit)
                        ->get();
    }

    public function getHaveNoProducts ()
    {
        return Category::leftJoin('products', 'categories.id', '=', 'products.category_id')
                        ->whereNull('products.id')
                        ->select('categories.name')
                        ->get();
    }
    
}

