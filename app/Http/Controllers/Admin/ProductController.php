<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\Response;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\admin\Product\CreateProductService;
use App\Services\admin\Product\DeleteProductService;
use App\Services\admin\Product\ListProductsService;
use App\Services\admin\Product\UpdateProductService;

class ProductController extends BaseController
{   
    public function index (ProductRequest $request, ListProductsService $listProducts) 
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? config('pagination.default');

        return $this->sendSuccessResponse($listProducts->execute($data, $perPage),'Retrieved products successfully',Response::OK);
    }
    public function store (ProductRequest $request, CreateProductService $createProduct) 
    {
        return $this->sendSuccessResponse($createProduct->execute($request->validated()),'Store product success',Response::OK);
    }
    public function update (ProductRequest $request, int $id, UpdateProductService $updateProduct) 
    {
        return $this->sendSuccessResponse($updateProduct->execute($id, $request->validated()),'Update product success',Response::OK);
    }
    public function delete (int $id, DeleteProductService $deleteProduct) 
    {
        return $this->sendSuccessResponse($deleteProduct->execute($id),'Delete product success',Response::OK);
    }
}

// use App\Helpers\Response;
// use App\Http\Controllers\Admin\BaseController;
// use App\Http\Requests\Admin\ProductRequest;
// use App\Services\admin\AdminDashboard\ProductStatsService;
// use App\Services\admin\ProductService;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
// use Livewire\Attributes\Validate;

// class ProductController extends BaseController
// {
//     /**
//      * @var object
//      */
//     protected $service;
//     protected $statisticsService;

//     /**
//      * ProductController constructor 
//      * 
//      * @param \App\Services\admin\ProductService $service The service instance responsible 
//      * for the product-related logic
//      */
//     public function __construct(ProductService $service, ProductStatsService $statisticService)
//     {
//         $this->service = $service;
//         $this->statisticsService = $statisticService;
//     }
//     /**
//      * A function to get the current authenticated user
//      * 
//      * @return \Illuminate\Contracts\Auth\Guard::user
//      */
//     public function getUser()
//     {

//         return $this->guard()->user();
//     }

//     public function productIndex(ProductRequest $request)
//     {   

//         $data = $request->validated();
//         $perPage = $data['per_page'] ?? config('pagination.default');
//         $listProducts = $this->service->productIndex($data, $perPage);
       
//         return $this->sendSuccessResponse($listProducts, "Retrieved products successfully", Response::OK);
//     }
//     /**
//      * A function receives the request from the user and call the product-related logic 
//      * 
//      * @param ProductRequest $request
//      *
//      * @return \Illuminate\Http\JsonResponse 
//      */
//     public function index(ProductRequest $request)
//     {

//         $validate = $request->validated();
//         $categoryId = $validate['category_id'] ?? [];
//         $perPage = $validate['per_page'] ?? config('pagination.default');
//         $user = $this->getUser();

//         $listProducts = $this->service->withUser($user)->index($categoryId, $perPage);

//         return $this->sendSuccessResponse($listProducts, null, Response::OK);
//     }
//     /**
//      * A controller function call the product-related logic service to get the
//      * detail of a specific product
//      * 
//      * @param int $id 
//      * 
//      * @return \Illuminate\Http\JsonResponse
//      */
//     public function detail($id)
//     {
//         $detailResult = $this->service->detail($id);

//         return $this->sendSuccessResponse($detailResult, "retrived details success", Response::OK);
//     }

//     public function store(ProductRequest $request)
//     {
//         $user = $this->getUser();
//         $validate = $request->validated();
//         $storeResult = $this->service->withUser($user)->store($validate);

//         return $this->sendSuccessResponse($storeResult, "store new product success", Response::OK);
//     }

//     public function update(ProductRequest $request, $id)
//     {
//         $user = $this->getUser();
//         $validate = $request->validated();
//         $updateResult = $this->service->withUser($user)->update($validate, $id);

//         return $this->sendSuccessResponse($updateResult, "update product success", Response::OK);
//     }

//     public function delete($id)
//     {
//         $user = $this->getUser();
//         $deleteResult = $this->service->withUser($user)->delete($id);

//         return $this->sendSuccessResponse($deleteResult, "delete success", Response::OK);
//     }
// 
//     public function getNew ($limit) in product read
//     {
//         $result = $this->statisticsService->getNewProds($limit);

//         return $this->sendSuccessResponse($result, "Retrieve data success", Response::OK);
//     }

//     public function getProductsInPriceRange (Request $request) in product read
//     {
//         $validated = $request->validate([
//             'price_limit' => ['required', 'numeric', 'min:0'],
//             'order' => ['sometimes', 'in:asc,desc'],
//         ]);

//         $priceLimit = $validated['price_limit'];
//         $order = $validated['order'] ?? 'asc';

//         $result =  $this->service->getProductsInPriceRange($priceLimit, $order);

//         return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
//     }

//     public function getTopSelling ($limit) in product read
//     {
//         $result = $this->service->getTopSelling($limit);

//         return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
//     }

//     public function getMostProfit (Request $request)
//     {
//         $validated = $request->validate([
//             'limit' => ['required', 'integer'],
//         ]);
//         $limit = $validated['limit'];
//         $result = $this->service->getMostProfitableProducts($limit);
//         Log::info($result);
//         return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
//     }

//     public function getCurrentMonthNewProduct ()
//     {
//         $result = $this->service->getCurrentMonthNewProduct();

//         return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
//     }

//     public function getOutOfStock ()
//     {
//         $result = $this->service->getOutOfStockProduct();

//         return $this->sendSuccessResponse($result, "Retrieved data successfully", Response::OK);
//     }

//     public function getDiscountProduct ()
//     {
//         $result = $this->service->getDiscountProduct();

//         return $this->sendSuccessResponse($result, 'Retrieve data success', Response::OK);
//     }

//     public function getLowProfit (Request $request)
//     {
//         $validated = $request->validate([
//             'limit' => ['required', 'integer'],
//             'threshold' => ['required', 'integer'],
//         ]);

//         $limit = $validated['limit'];
//         $threshold = $validated['threshold'];

//         $result = $this->statisticsService->getLowProfit($limit, $threshold);

//         return response()->json($result);
//     }
//     public function getTopSellingTrend (Request $request)
//     {
//         $validated = $request->validate([
//             'limit' => ['required', 'integer'],
//         ]);

//         $limit = $validated['limit'];
//         $result = $this->statisticsService->getTopSellingTrend($limit);
        
//         return $this->sendSuccessResponse($result, "Retrieved data successfully", Response::OK);
//     }
//     public function getSoldThisMonth (Request $request)
//     {
//         $validated = $request->validate([
//             'id' => 'required|integer|min:0'
//         ]);
//         $soldThisMonth = $this->statisticsService->getSoldThisMonth($validated['id']);

//         return $this->sendSuccessResponse($soldThisMonth, "Retrieved data successfully", Response::OK);
//     }

//     public function getCountVisit (Request $request) 
//     {
//         $validated = $request->validate([
//             'id' => 'required|integer|min:0'
//         ]);
//         $data = $this->statisticsService->countProductVisit($validated['id']);

//         return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
//     }

//     public function getConversionRate (Request $request)
//     {
//         $validated = $request->validate([
//             'id' => 'required|integer|min:0'
//         ]);
//         $data = $this->statisticsService->getConversionRate($validated['id']);

//         return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
//     }
    
//     public function countRepeatedPurchasingUsers(Request $request)
//     {
//         $validated = $request->validate([
//             'id' => "required|integer|min:0"
//         ]);
//         $data = $this->statisticsService->countRepeatedPurchasingUsers($validated['id']);

//         return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
//     }
// }
