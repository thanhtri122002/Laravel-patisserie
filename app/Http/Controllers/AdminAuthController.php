<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class AdminAuthController extends Controller
{
    public function showLoginForm (Request $request) {
        return view('admin.login');
    }
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Login failed');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        
    }
}
