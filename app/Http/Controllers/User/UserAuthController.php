<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

    public function showLogin() {
        return 'hello in log in';
    }

    public function login(LoginRequest $request) {
        AuthService::getInstance()->login($request);
        return redirect()->route('user.login');
    }

    public function register(RegisterRequest $request) {

        AuthService::getInstance()->register($request);
        return redirect()->route('user.profile');
    }
}
