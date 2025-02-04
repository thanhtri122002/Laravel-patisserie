<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\admin\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    protected $service;

    public function __construct(ProductService $service){
        $this->service = $service;
        
    }

    public function getUser(){

        return $this->guard()->user();
    }

    public function index() {

        $user = $this->getUser();
        $listProducts = $this->service->withUser($user)->index();
        
        return $this->sendSuccessResponse($listProducts, null, Response::OK);
    }
    public function detail(Request $request ,$id) {

        $user = $this->getUser();
        $validate = $request->validated();
        $detailResult = $this->service->withUser($user)->detail($id);

        return $this->sendSuccessResponse($detailResult, "retrived details success", Response::OK);
    }

    public function store(ProductRequest $request){
        $user = $this->getUser();
        $validate = $request->validated();
        $storeResult = $this->service->withUser($user)->store($validate);

        return $this->sendSuccessResponse($storeResult, "store new product success", Response::OK);

    }

    public function update(ProductRequest $request, $id) {
        $user = $this->getUser();
        $validate = $request->validated();
        $updateResult = $this->service->withUser($user)->update($validate, $id);

        return $this->sendSuccessResponse($updateResult, "update product success", Response::OK);
    }

    public function delete($id) {
        $user = $this->getUser();
        $deleteResult = $this->service->withUser($user)->delete($id);

        return $this->sendSuccessResponse($deleteResult, "delete success", Response::OK);
    }
}
