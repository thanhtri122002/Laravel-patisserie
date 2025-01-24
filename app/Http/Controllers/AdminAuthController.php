<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }
    public function showLoginForm (Request $request) {
        return view('admin.login');
    }
    public function login(LoginRequest $request) {

        $credentials = $request->validated();
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Login failed');
    }
    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
    
    public function create(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed'
        ]);
        $validate['password'] = Hash::make($validate['password']);
        Admin::create($validate);
        return redirect()->route('admin.login')->with('success', 'Admin created successfully');
    }

}
