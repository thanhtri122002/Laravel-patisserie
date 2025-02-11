<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\BaseController;
use App\Http\Requests\Auth\User\ResetPassword;
use App\Services\Auth\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseController
{
    public function show(Request $request) {

        $ResetFormLink = ResetPasswordService::getInstance()->show($request);
        return $ResetFormLink;
    }

    public function handle(ResetPassword $request)
    {
        $validate = $request->validated();
        $resetPasswordService = ResetPasswordService::getInstance()->handle($validate);
        
    }
}
