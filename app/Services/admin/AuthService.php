<?php

namespace App\Services\admin;

use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service
{

    public function login($request)
    {   
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return true;
        }

        return false;
    }

    public function logout($request)
    {
        $request->user()->currentAccessToken()->delete();

        return ['success' => true, "message" => "Logout successfully"];
    }

    public function store($validate)
    {
        $validate['password'] = Hash::make($validate['password']);

        return Admin::create($validate);
    }
}
