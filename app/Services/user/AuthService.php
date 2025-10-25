<?php
namespace App\Services\user;

use App\Events\UserLogin;
use App\Http\Requests\user\Auth\LoginRequest;
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service {
  
    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) return false;
        
        if (!Hash::check($credentials['password'], $user->password)) return false;
        
        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();
            UserLogin::dispatch(Auth::guard('web')->user());
            
            return true;
        }
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
    }

    public function register($validate) 
    {
        $validate['password'] = Hash::make($validate['password']);
        $user = User::create($validate);
        Auth::login($user);
        
        return $user;
    }
}