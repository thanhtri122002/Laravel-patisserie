<?php

namespace App\Services\admin;

use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service {

    public function login($credentials) 
    {
       
       $admin = Admin::where('email', $credentials['email'])->first();

       if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
        return false;
       }
       
       return $admin->createToken('admin-api')->plainTextToken;
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