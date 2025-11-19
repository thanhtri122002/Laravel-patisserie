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
    /**
     * a function to get currently auth user
     * 
     * @return \Illuminate\Contracts\Auth\Guard::user
     */
    public function getCurrentAuthUser(Request $request)
    {   
        return response()->json($request->user());
    }
    /**
     * Log in controller for the admin which receive the formrequest 
     * Call the login authenticate service 
     * If success return success response
     * 
     * @param \App\Http\Requests\admin\Auth\LoginRequest
     * 
     * @return  \App\Helpers\Response
     */
    public function login(LoginRequest $request)
    {   
        $accessToken = AuthService::getInstance()->login($request);
        if ($accessToken) {
            return $this->sendSuccessResponse($accessToken, "Log in successfully", Response::ACCEPTED)
                ->cookie(
                    'admin_token',   // cookie name
                    $accessToken,     // cookie value
                    60 * 24,         // lifetime in minutes
                    '/',             // path
                    '127.0.0.1',            // domain (null = current)
                    true,            // secure (HTTPS only)
                    true,            // httpOnly
                    false,           // raw
                    'None'         // SameSite
                );
        }

        return $this->sendFailedResponse(null, "Something wrong", Response::UNAUTHORIZED, ['email' => ['The provided credentials do not match our records.']]);
    }
    /**
     * Log out controller method
     * 
     * Receive the request and take the currently auth user to the log out service
     * Send success response if log out is processed
     * 
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \App\Helpers\Response
     */
    public function logout(Request $request)
    {
        $admin = $this->getCurrentAuthUser();

        $isSuccess= AuthService::getInstance()->withUser($admin)->logout($request);

        return $this->sendSuccessResponse($isSuccess, "Log out successfully", Response::OK);
    }
    /**
     * Register a new admin 
     * Validate the register request form, take the current auth admin to the store service
     * If new admin created, send success response
     * 
     * @param \App\Http\Requests\admin\Auth\RegisterRequest
     * 
     * @return \App\Helpers\Response
     */
    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();
        $admin = $this->getCurrentAuthUser();
        $registerResult = AuthService::getInstance()->withUser($admin)->store($validated);

        return $this->sendSuccessResponse($registerResult, "create admin success", Response::OK);
    }
}
