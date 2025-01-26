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

    public function showLoginForm () {

        return view('admin.login');
    }

    public function login(LoginRequest $request) {

        $credentials = $request->validated();
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            dd(session()->all());
            
            return redirect()->route('admin.dashboard');
        }
        dd('da');
        return redirect()->route('admin.login')->withErrors('Login failed');
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
    
    public function create(Request $request) {
        dd(session()->all());
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed'
        ]);
        $validate['password'] = Hash::make($validate['password']);
        Admin::create($validate);
        return redirect()->route('admin.login')->with('success', 'Admin created successfully.');

    }
}
