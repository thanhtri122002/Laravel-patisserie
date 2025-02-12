<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\BaseController;
use App\Http\Requests\Auth\User\SendResetLinkRequest;
use App\Services\Auth\PasswordResetLinkService;
use Illuminate\Http\Request;

class PasswordResetLinkController extends BaseController
{   
    public function show()
    {
        //$showForm = PasswordResetLinkService::getInstance()->show();
        //return $showForm;
    }

    public function handle(SendResetLinkRequest $request) 
    {   
        $validated = $request->validated();
        ;
        $email = $request->input('email');
        $sendLink = PasswordResetLinkService::getInstance()->handle($email, $this->broker);

        return $sendLink;
    }

    
}
