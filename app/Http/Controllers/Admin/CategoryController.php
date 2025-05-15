<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;

use App\Http\Requests\admin\CategoryRequest;
use App\Services\admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{   
    public function getUser() {
        return $this->guard()->user();
    }

    public function index() {
        $user = $this->getUser();
        $categorySerice = CategoryService::getInstance()->withUser($user)->index();

        return $this->sendSuccessResponse($categorySerice, "success retrieveeeee", Response::OK);
    }

    public function create(CategoryRequest $request) {
        $user = $this->getGuard();
        $data = $request->validated();
        $createResult = CategoryService::getInstance()->withUser($user)->create($data);

        return $this->sendSuccessResponse($createResult, "success create", Response::OK);
    }

    public function update(CategoryRequest $request, $id) {
        $user = $this->getUser();
        $data = $request->validated();

        $updateResult = CategoryService::getInstance()->withUser($user)->update($data, $id);
        return $this->sendSuccessResponse($updateResult, "success updated", Response::OK);
    }

    public function delete($id) {
        $user = $this->getUser();
        $deleteResult = CategoryService::getInstance()->withUser($user)->delete($id);
        return $this->sendSuccessResponse($deleteResult, "success deleted", Response::OK);
        
    }
}
