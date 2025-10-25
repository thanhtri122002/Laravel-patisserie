<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Response;
use App\Http\Requests\admin\Auth\LoginRequest;
use App\Http\Requests\admin\Auth\RegisterRequest;
use App\Services\admin\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

class AdminAuthController extends BaseController
{

    protected function getCurrentAuthUser()
    {

        return $this->guard()->user();
    }

    public function showLoginForm()
    {

        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {   
        $isSuccess = AuthService::getInstance()->login($request);

        if ($isSuccess) {
            return $this->sendSuccessResponse($isSuccess, "Log in successfully", Response::ACCEPTED);
        }

        return $this->sendFailedResponse(null, "Something wrong", Response::UNAUTHORIZED, ['email' => ['The provided credentials do not match our records.']]);
    }

    public function logout(Request $request)
    {
        $admin = $this->getCurrentAuthUser();

        $logoutResult = AuthService::getInstance()->withUser($admin)->logout($request);

        return redirect()->route('admin.login')->withSuccess(['message' => $logoutResult['message']]);
    }

    public function store(RegisterRequest $request)
    {

        $admin = $this->getCurrentAuthUser();

        $registerResult = AuthService::getInstance()->withUser($admin)->store($request);
        return $this->sendSuccessResponse($registerResult, "create admin success", Response::OK);
    }
}
