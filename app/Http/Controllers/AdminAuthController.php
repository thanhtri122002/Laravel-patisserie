<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\Auth\LoginRequest;
use App\Http\Requests\admin\Auth\RegisterRequest;
use App\Http\Requests\user\Auth\RegisterRequest as AuthRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    
    public function showLoginForm () {

        return view('admin.login');
    }
    public function showDashboard() {

        return 'hello';
    }
    
    public function login(LoginRequest $request) {
        
        $credentials = $request->validated();
        
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            dd(session()->all());
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
    
    public function create(AuthRegisterRequest $request) {
        if (!Auth::guard('admin')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validate = $request->validated();
        
        $validate['password'] = Hash::make($validate['password']);
        Admin::create($validate);
        return response()->json(['success' => 'created new admin'], 200);

    }
}
