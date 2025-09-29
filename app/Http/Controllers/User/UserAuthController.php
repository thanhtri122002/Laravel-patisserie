<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Requests\user\Auth\LoginRequest;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Services\user\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends BaseController
{
    protected function getCurrentUser() {

        return $this->guard()->user();
    }

    public function login(LoginRequest $request) 
    {
        $isSuccess = AuthService::getInstance()->login($request);
        if ($isSuccess) {
            
            return $this->sendSuccessResponse($isSuccess, "login successful", Response::OK);
        }
        
        return false;
    }

    public function register(RegisterRequest $request) 
    {   
        $validated = $request->validated();
        $user = AuthService::getInstance()->register($validated);
        
        return $this->sendSuccessResponse($user, 'register successfully', Response::OK);
    }

    public function logout(Request $request) 
    {
        $user = $this->getCurrentUser();
        AuthService::getInstance()->withUser($user)->logout($request);

        return redirect('/home');
    }
}
