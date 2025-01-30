<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Auth\LoginRequest;
use App\Http\Requests\admin\Auth\RegisterRequest;
use App\Services\admin\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends BaseController
{   
    
    protected function getCurrentAuthUser() {

        return $this->guard()->user();
    }

    public function showLoginForm() {
        
        return view('admin.login');
    }

    public function showDashboard () {

        return $this->guard()->user();
    }

    public function login(LoginRequest $request) {
        
        AuthService::getInstance()->login($request);
       
        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request) {
        $admin = $this->getCurrentAuthUser();
        $logoutResult = AuthService::getInstance()->withUser($admin)->logout($request);

        return redirect()->route('admin.login')->withSuccess(['message' => $logoutResult['message']]);
    }

    public function create(RegisterRequest $request) {
        
        $admin = $this->getCurrentAuthUser();
        
        $registerResult = AuthService::getInstance()->withUser($admin)->create($request);
        return response()->json(['message' => "success"]);
    }
    
}
