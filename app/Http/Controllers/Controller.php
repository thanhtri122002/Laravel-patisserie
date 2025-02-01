<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Controller {

    const CONTINUE = 100;
    const SWITCHING_PROTOCOLS = 101;

    // 2xx Success
    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NO_CONTENT = 204;

    // 3xx Redirection
    const MOVED_PERMANENTLY = 301;
    const FOUND = 302;
    const NOT_MODIFIED = 304;

    // 4xx Client Errors
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const UNPROCESSABLE_ENTITY = 422;

    // 5xx Server Errors
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    
    protected function getGuard(): string {
        return property_exists($this, 'guard') ? $this->guard : config('auth.default.guard');
    }

    protected function guard() {
        return Auth::guard($this->getGuard());
    }

    protected function sendSuccessResponse($data, $message, $status) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function sendFailedResponse($errors, $message, $status) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors 
        ], $status);
    }

}