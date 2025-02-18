<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\ProductDetailRequest;
use App\Services\user\ProductDetailService;

class ProductDetailController extends Controller
{   
    private function getUser()
    {
        return $this->guard()->user();
    }

    public function create(ProductDetailRequest $request)
    {
        $data = $request->validated();
        $productDetail = ProductDetailService::getInstance()->create($data);
        
        return $productDetail;
    }

    public function detail($id)
    {
        $user = $this->getUser();
        $productDetail = ProductDetailService::getInstance()->withUser($user)->find($id);
        
        return $productDetail;
    }

    public function update(ProductDetailRequest $request, $id)
    {
        $user = $this->getUser();
        $data = $request->validated();
        $updateDetail = ProductDetailService::getInstance()->withUser($user)->update($id, $data);
        
        return $updateDetail;
    }

    public function delete($id)
    {
        $user = $this->getUser();
        $deleteDetail = ProductDetailService::getInstance()->withUser($user)->delete($id);

    }
}
