<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class BaseController extends Controller
{   
    /**
     * @var string $guard Guard name.
     */
    protected $guard = 'web';

    /**
     * @var string $broker Broker name.
     */
    protected $broker ='users';
}
