<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Requests\admin\Auth\LoginRequest;
use App\Http\Requests\admin\Auth\RegisterRequest;
use App\Http\Requests\user\Auth\RegisterRequest as AuthRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Services\admin\AuthService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }
    
    public function login(LoginRequest $request) {
        
        $credentials = $request->validated();
        $token = $this->service->login($request, $credentials);

        if (!$token){
            return $this->sendFailedResponse(null, "Login failed", Response::BAD_REQUEST, ['Invalid credentials']);
        }
        
        return $this->sendSuccessResponse([
            'token' => $token,
            'token_type' => "Bearer"
        ], 'Log in successfully', Response::OK);
    }

    public function logout(Request $request) {
        
        $logOutAttempt = $this->service->withUser(Auth::guard('admin')->user())->logout($request);

        return $this->sendSuccessResponse(null, "Logout successful", Response::OK);
    }
    
    public function create(AuthRegisterRequest $request) {
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validate = $request->validated();
        $newAdmin = $this->service->withUser(Auth::guard('admin')->user())->store($validate);
        
        return $this->sendSuccessResponse($newAdmin, "Create new admin successfully", Response::OK);

    }
}
