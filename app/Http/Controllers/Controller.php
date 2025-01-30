<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Controller {

    protected function getGuard(): string {
        return property_exists($this, 'guard') ? $this->guard : config('auth.default.guard');
    }

    protected function guard() {
        return Auth::guard($this->getGuard());
    }

}