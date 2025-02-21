<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class BaseController extends Controller
{
    protected $guard = 'web';
    protected $broker ='users';
}
