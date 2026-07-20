<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use Illuminate\Support\Facades\Auth;

class Controller {
    
    /**
     * A function to get the authentication guard to be used
     * 
     * This method check if the property 'guard' is exists in the class
     * if it does, it return its value, otherwise it return the default value 
     * guard defined in the auth default configuration
     * 
     * @return string the authentication guard name
     */
    protected function getGuard(): string 
    {
        return property_exists($this, 'guard') ? $this->guard : config('auth.default.guard');
    }

    /**
     * a function to get the guard instanace being used by the authentication system
     * 
     * This method returns the guard instance resolved by Auth::guard() method 
     * based on the getGuard method of this classs which is allow the flexible  authentication for classes
     * that support  multiple guards context
     * 
     * @return \Illuminate\Contracts\Auth\Guard the authentication guard instanace
     */
    protected function guard() 
    {
        return Auth::guard($this->getGuard());
    }

    /**
     * Send a standardlized success Json response
     * 
     * This method delegates to the Response helper to return a formatted response 
     * indicating  a success operation
     * 
     * @param mixed $data  The data to include in the response (can be array, object, etc.).
     * @param string @message 
     * @param int $status  The HTTP status code to use for the response (default: 200).
     * @param mixed $errors  The error messages to include in the response (can be array, object, etc.).
     * 
     * @return \App\Helpers\Response
     */
    protected function sendSuccessResponse($data, $message, $status, $errors = null) 
    {
       return Response::sendResponse($data, $message, $status, $errors);
    }

    /**
     * Send a standardized failed JSON response.
     *
     * This method delegates to the Response helper to return a formatted response
     * indicating a failed or erroneous operation.
     *
     * @param mixed|null $data     Optional data to include (e.g., context or debug info).
     * @param string $message      A descriptive error message.
     * @param int $status          The HTTP status code (typically 400–500 range).
     * @param array $errors        List of validation or application errors.
     *
     * @return \App\Helpers\Response
    */
    protected function sendFailedResponse($data = null, $message, $status, $errors) 
    {
        return Response::sendResponse($data, $message, $status, $errors);
    }

}