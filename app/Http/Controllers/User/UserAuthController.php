<?php

namespace App\Http\Controllers\User;

use App\Helpers\Response;
use App\Http\Requests\user\Auth\LoginRequest;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Services\user\AuthService;
use Illuminate\Http\Request;
class UserAuthController extends BaseController
{   
    /**
     * A function to get the current user
     * 
     * @return \Illuminate\Contracts\Auth\Guard::user
     */
    protected function getCurrentUser() {

        return $this->guard()->user();
    }
    /**
     * Handle incoming login request
     * 
     * Receive the loginRequst request form and send to the authenticate service
     * If success send success json response, if not send failed responss
     * 
     * @param \App\Http\Requests\user\Auth\LoginRequest $request
     * 
     * @return \App\Helpers\Response
     */
    public function login(LoginRequest $request) 
    {
        $isSuccess = AuthService::getInstance()->login($request);
      
        if ($isSuccess) {
            
            return $this->sendSuccessResponse($isSuccess, "login successful", Response::OK);
        }
        
        return $this->sendFailedResponse($isSuccess, "Invalid Credentials", Response::UNAUTHORIZED, null);
    }
    /**
     * Register an user 
     * 
     * Receive the resgiter request requestForm and call the authenticate service
     * If success send success response
     * 
     * @param \App\Http\Requests\user\Auth\RegisterRequest
     * 
     * @return \App\Helpers\Response
     */
    public function register(RegisterRequest $request) 
    {   
        $validated = $request->validated();
        $user = AuthService::getInstance()->register($validated);
        
        return $this->sendSuccessResponse($user, 'register successfully', Response::OK);
    }
    /**
     * Log out an user 
     * 
     * Receive the request and call the authenticate service, if success send success response
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return \App\Helpers\Response
     */
    public function logout(Request $request) 
    {
        $user = $this->getCurrentUser();
        $isSuccess = AuthService::getInstance()->withUser($user)->logout($request);

        return $this->sendSuccessResponse($isSuccess, "Log out successfully", Response::OK);
    }
}
