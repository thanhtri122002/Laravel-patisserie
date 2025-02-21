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
    
    protected function getCurrentAuthUser() {

        return $this->guard()->user();
    }

    public function showLoginForm() {
        
        return view('admin.login');
    }

    public function login(LoginRequest $request) {
        
        AuthService::getInstance()->login($request);
       
        return $this->getCurrentAuthUser();
    }

    public function logout(Request $request) {
        $admin = $this->getCurrentAuthUser();
        
        $logoutResult = AuthService::getInstance()->withUser($admin)->logout($request);
        
        return redirect()->route('admin.login')->withSuccess(['message' => $logoutResult['message']]);
    }

    public function store(RegisterRequest $request) {
        
        $admin = $this->getCurrentAuthUser();
        
        $registerResult = AuthService::getInstance()->withUser($admin)->store($request);
        return $this->sendSuccessResponse($registerResult, "create admin success", Response::OK);
    }
    
}
