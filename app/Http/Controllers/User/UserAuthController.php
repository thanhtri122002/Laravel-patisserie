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

        return view('user.login');
    }

    public function login(LoginRequest $request) {

        
        $success = AuthService::getInstance()->login($request);
        if ($success) {
            
            return redirect('/');
        }
        
        return 'false';
    }

    public function register(RegisterRequest $request) {
        
        AuthService::getInstance()->register($request);
        return true;
    }

    public function logout(Request $request) {

        $user = $this->getCurrentUser();
        dd($user);
        $logOut = AuthService::getInstance()->withUser($user)->logout($request);
        
    }
}
