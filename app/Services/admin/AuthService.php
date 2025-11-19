<?php

namespace App\Services\admin;

use App\Models\Admin;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service
{
<<<<<<< HEAD
    /**
     * Log in service
     * First validate the request form then attempt to log the admin 
     * 
     * @param \App\Http\Requests\admin\Auth\LoginRequest
     * 
     * @return boolean
     */
    public function login($request)
    {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt($credentials)) {
            
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('admin-token')->plainTextToken;
            $tokenParts = explode("|", $token);
            $plainToken = $tokenParts[1];

            return $plainToken;
=======

    public function login($request)
    {   
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return true;
>>>>>>> master
        }

        return false;
    }
<<<<<<< HEAD
    /**
     * Log out service
     * 
     * @param \Illuminate\Http\Request
     * 
     * @return boolean
     */
=======

>>>>>>> master
    public function logout($request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return true;
    }
<<<<<<< HEAD
    /**
     * Register new admin 
     * 
     * @param array $validate
     * 
     * @return \App\Models\Admin
     */
=======

>>>>>>> master
    public function store($validate)
    {
        $validate['password'] = Hash::make($validate['password']);
        $admin = Admin::create($validate);

        return $admin;
    }
}
