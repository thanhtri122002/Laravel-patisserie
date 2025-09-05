<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Requests\user\Auth\LoginRequest;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Services\user\AuthService;
use Illuminate\Http\Request;

class UserAuthController extends BaseController
{
    protected function getCurrentUser() {

        return $this->guard()->user();
    }

      
    public function showProfile() {
    
        return 'hello';
    }

    public function showLoginForm() 
    {
        return view('user.login');
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
        AuthService::getInstance()->register($request);
        
        return true;
    }

    public function logout(Request $request) 
    {
        $user = $this->getCurrentUser();
        AuthService::getInstance()->withUser($user)->logout($request);

        return redirect('/');
    }
}
