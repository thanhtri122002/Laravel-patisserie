<?php

namespace App\Http\Controllers\User;

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

    public function showLoginForm() {

        return 'hello';
    }

    public function login(LoginRequest $request) {

        
        AuthService::getInstance()->login($request);
        
    }

    public function register(RegisterRequest $request) {

        AuthService::getInstance()->register($request);
        return redirect()->route('user.profile');
    }

    public function logout(Request $request) {

        $user = $this->getCurrentUser();
        dd($user);
        $logOut = AuthService::getInstance()->withUser($user)->logout($request);
        
    }
}
