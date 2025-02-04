<?php

namespace App\Helpers;

class Response {

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

    public static function sendResponse($data ,$message , $status, $errors) {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status,
            'error' => $errors
        ]);
    }
}