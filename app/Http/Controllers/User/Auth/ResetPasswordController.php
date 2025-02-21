<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\BaseController;
use App\Http\Requests\Auth\User\ResetPassword;
use App\Services\Auth\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseController
{   
    public function getUser(){

        return $this->guard()->user();
    }

    public function show(Request $request) 
    {   
        $user = $this->getUser();
        $ResetFormLink = ResetPasswordService::getInstance()->withUser($user)->show($request);

        return $ResetFormLink;
    }

    public function handle(ResetPassword $request)
    {      
        $user = $this->getUser();
        $broker = $this->broker;
        $validate = $request->validated();
        
        $resetPasswordService = ResetPasswordService::getInstance()->withUser($user)->handle($validate, $broker);

        
    }
}
