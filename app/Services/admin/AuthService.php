<?php

namespace App\Services\admin;

use App\Http\Requests\admin\Auth\LoginRequest;
use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service {

    public function login($request) {
        $validate = $request->validated();
        if (Auth::guard('admin')->attempt($validate)) {
            $request->session()->regenerate(); // Regenerate session here
        }
    }
    
    public function logout($request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return ['success' => true, "message" => "Logout successfully"];
    }

    public function store($request) {

        $validate = $request->validated();
        $validate['password'] = Hash::make($validate['password']);
        $admin = Admin::create($validate);
        return $admin;
    }

}