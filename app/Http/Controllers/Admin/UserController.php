<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\admin\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index(UserRequest $request)
    {
        $data = $request->validated();
        $perPage = $data['per_page'] ?? config('pagination.default');
        $users = $this->service->index($data, $perPage);

        return $this->sendSuccessResponse($users, 'Retrieved users successfully', Response::OK);
    }
}
