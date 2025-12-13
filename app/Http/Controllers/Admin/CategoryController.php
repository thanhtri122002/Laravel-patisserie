<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;

use App\Http\Requests\admin\CategoryRequest;
use App\Services\admin\AdminDashboard\CategoryStatService;
use App\Services\admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{   
    public function getUser() {
        return $this->guard()->user();
    }

    public function index(CategoryRequest $request) 
    {   
        $user = $this->getUser();
        $data = CategoryService::getInstance()->withUser($user)->index();

        return $this->sendSuccessResponse($data, "success retrieveeeee", Response::OK);
    }

    public function getHaveMostProducts (Request $request)
    {   
        $user = $this->getUser();
        $validated = $request->validate([
            'limit' => ['required', 'integer'],
        ]);

        $data = CategoryStatService::getInstance()->withUser($user)->getHaveMostProducts($validated['limit']);

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }

    public function getMostProfit (Request $request)
    {
        $user = $this->getUser();
        $validated = $request->validate([
            'limit' => ['required', 'integer'],
        ]);
        $data = CategoryStatService::getInstance()->withUser($user)->getMostProfit($validated['limit']);

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }

    public function getHaveNoProducts ()
    {   
        $user = $this->getUser();
        $data = CategoryStatService::getInstance()->withUser($user)->getHaveNoProducts();

        return $this->sendSuccessResponse($data, "Retrieved data successfully", Response::OK);
    }

    public function create (CategoryRequest $request) {
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
