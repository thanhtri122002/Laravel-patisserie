<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\BaseController;
use App\Services\ProductFilterService;
use Illuminate\Http\Request;

class ProductFilterController extends BaseController
{   
    protected $service;

    public function __construct(ProductFilterService $service) {
        $this->service = $service;
    }

    public function getNewProduct(int $limit = 3) 
    {   
        $newProducts = $this->service->getNewProduct($limit);

        return $newProducts;
    }

    public function getProductsInPriceRange($priceLimit, $order)
    {
        $products = $this->service->getProductsInPriceRange($priceLimit, $order);
       
        return $products;
    }

    public function getTopSellingProducts($limit)
    {
        $products = $this->service->getTheTopSellingProduct($limit);

        return $products;
    }

    public function getProductsBySearching($inputString)
    {
        $products = $this->service->getProductsBySearching($inputString);

        return $products;
    }

    public function getMostProfitableProducts($limit)
    {   
        
        $products = $this->service->getMostProfitableProduct($limit);

        return $products;
    }

    public function getCurrentMonthNewProduct()
    {
        $products = $this->service->getCurrentMonthNewProduct();

        return $products;
    }

    public function getOutOfStockProducts()
    {
        $products = $this->service->getOutOfStockProduct();

        return $products;
    }

    public function getDisCountProduct()
    {
        $products = $this->service->getDisCountProduct();

        return $products;
    }
}
