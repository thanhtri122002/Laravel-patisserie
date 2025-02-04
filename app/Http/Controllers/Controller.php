<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use Illuminate\Support\Facades\Auth;

class Controller {
    
    protected function getGuard(): string {
        
        return property_exists($this, 'guard') ? $this->guard : config('auth.default.guard');
    }

    protected function guard() {
        return Auth::guard($this->getGuard());
    }

    protected function sendSuccessResponse($data, $message, $status, $errors = null) {
       return Response::sendResponse($data, $message, $status, $errors);
    }

    protected function sendFailedResponse($data = null, $message, $status, $errors) {
        return Response::sendResponse($data, $message, $status, $errors);
    }

}