<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\BaseController;
use App\Services\Auth\PasswordResetLinkService;
use Illuminate\Http\Request;

class PasswordResetLinkController extends BaseController
{
    public function show()
    {
        //$showForm = PasswordResetLinkService::getInstance()->show();
        //return $showForm;
    }

    public function handle(Request $request) 
    {   
        $email = $request->validate(['email' => 'required|email']);
        $sendLink = PasswordResetLinkService::getInstance()->handle($email);
        return $sendLink;
    }

    
}
