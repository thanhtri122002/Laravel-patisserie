<?php
namespace App\Services\user;

use App\Http\Requests\user\Auth\LoginRequest;
use App\Http\Requests\user\Auth\RegisterRequest;
use App\Models\User;
use App\Services\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService extends Service {
  
    public function login(LoginRequest $request) {
        $credentials = $request->validated();
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            dd('❌ User not found');
        }

        // Step 3: Check password
        if (!\Hash::check($credentials['password'], $user->password)) {
            dd('❌ Password does not match');
        }
            
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return true;
        }
        return false;
       
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();
        
    }

    public function register(RegisterRequest $request) {

        $validate = $request->validated();
        $validate['password'] = Hash::make($validate['password']);
        User::create($validate);

    }
}