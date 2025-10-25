<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Requests\admin\ProductImageRequest;
use App\Services\admin\ProductImageService;

class ProductImageController extends BaseController
{
    protected function getUser() {
        return $this->guard()->user();
    }

    public function index() {
        $listImages = ProductImageService::getInstance()->index();
        
        return $this->sendSuccessResponse($listImages, 'retrieved data successfully', Response::OK);
    }

    public function store(ProductImageRequest $request)
    {
        $validated = $request->validated();
        $storeResult = ProductImageService::getInstance()->store($validated);
        return $this->sendSuccessResponse($storeResult, 'store succesfully', Response::OK);
    }

    public function detail($id) 
    {
        $imageDetail = ProductImageService::getInstance()->index();
        return $this->sendSuccessResponse($imageDetail, null, Response::OK);
    }

    public function update(ProductImageRequest $request, $id) 
    {
        $validated = $request->validated();
        $updateResult = ProductImageService::getInstance()->update($validated, $id);

        return $this->sendSuccessResponse($updateResult, "update successfully", Response::OK);
    }

    public function delete($id) 
    {
        $deleteResult = ProductImageService::getInstance()->delete($id);

        return $this->sendSuccessResponse(null, 'delete successfully', Response::OK);
    }
}
