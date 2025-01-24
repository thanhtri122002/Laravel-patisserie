<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure this is included

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        // Validate the incoming request data
        $credentials = $request->validated();

        // Attempt to authenticate the user using the 'web' guard
        if (Auth::guard('web')->attempt($credentials)) {
            // If successful, regenerate the session and redirect
            $request->session()->regenerate();
            return redirect()->route('user.dashboard');
        }

        // If authentication fails, redirect back with an error message
        return redirect()->back()->withErrors('Login failed');
    }

    public function logout(Request $request)
    {
        // Logout the user using the 'web' guard
        Auth::guard('web')->logout();
        // Invalidate the session and regenerate the token for security
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('user.login');
    }

    public function register(Request $request) {
        $validate = $request->validate([
            'name' => "required",
            'email' => "required|unique:users",
            'password' => "required|min:8|confirmed",
        ]);
        User::create($validate);
        return redirect()->back()->with('success', 'Register successfully');
    }
}
