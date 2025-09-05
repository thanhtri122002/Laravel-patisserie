<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\admin\ProductService;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class ProductController extends BaseController
{   
    /**
     * @var object
     */
    protected $service;

    /**
     * ProductController constructor 
     * 
     * @param \App\Services\admin\ProductService $service The service instance responsible 
     * for the product-related logic
     */
    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * A function to get the current authenticated user
     * 
     * @return \Illuminate\Contracts\Auth\Guard::user
     */
    public function getUser(){

        return $this->guard()->user();
    }

    public function productIndex(ProductRequest $request)
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? config('pagination.default');
        $listProducts = $this->service->productIndex($data, $perPage);
        
        return $this->sendSuccessResponse($listProducts, "Retrieved products successfully", Response::OK);
    }
    
    /**
     * A function receives the request from the user and call the product-related logic 
     * 
     * @param ProductRequest $request
     *
     * @return \Illuminate\Http\JsonResponse 
     */
    public function index(ProductRequest $request) {

        $validate = $request->validated();
        $categoryId = $validate['category_id'] ?? [];
        $perPage = $validate['per_page'] ?? config('pagination.default');
        $user = $this->getUser();

        $listProducts = $this->service->withUser($user)->index($categoryId, $perPage);
        
        return $this->sendSuccessResponse($listProducts, null, Response::OK);
    }

    /**
     * A controller function call the product-related logic service to get the
     * detail of a specific product
     * 
     * @param int $id 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail($id)
    {
        $user = $this->getUser();
        $detailResult = $this->service->detail($id);

        return $this->sendSuccessResponse($detailResult, "retrived details success", Response::OK);
    }

    public function store(ProductRequest $request)
    {
        $user = $this->getUser();
        $validate = $request->validated();
        $storeResult = $this->service->withUser($user)->store($validate);

        return $this->sendSuccessResponse($storeResult, "store new product success", Response::OK);

    }

    public function update(ProductRequest $request, $id) 
    {
        $user = $this->getUser();
        $validate = $request->validated();
        $updateResult = $this->service->withUser($user)->update($validate, $id);

        return $this->sendSuccessResponse($updateResult, "update product success", Response::OK);
    }

    public function delete($id) 
    {
        $user = $this->getUser();
        $deleteResult = $this->service->withUser($user)->delete($id);

        return $this->sendSuccessResponse($deleteResult, "delete success", Response::OK);
    }

    public function getNewProduct($limit)
    {
        $result = $this->service->getNewProduct($limit);

        return $this->sendSuccessResponse($result, "Retrieve data success", Response::OK);
    }

    public function getProductsInPriceRange(Request $request)
    {
        $validated = $request->validate([
            'price_limit' => ['required', 'numeric', 'min:0'],
            'order' => ['sometimes', 'in:asc,desc'],
        ]);

        $priceLimit = $validated['price_limit'];
        $order = $validated['order'] ?? 'asc';

        $result =  $this->service->getProductsInPriceRange($priceLimit, $order);

        return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
    }

    public function getTopSellingProducts($limit)
    {
        $result = $this->service->getTheTopSellingProduct($limit);

        return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
    }

    public function getMostProfitableProducts(Request $request)
    {
        $validated = $request->validate([
            'limit' => ['required', 'int']
        ]);
        $limit = $validated['limit'];
        $result = $this->service->getMostProfitableProducts($limit);

        return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
    }

    public function getCurrentMonthNewProduct()
    {
        $result = $this->service->getCurrentMonthNewProduct();

        return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
    }

    public function getOutOfStockProduct()
    {
        $result = $this->service->getOutOfStockProduct();
    }

    public function getDiscountProduct()
    {
        $result = $this->service->getDiscountProduct();

        return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
    }
}
