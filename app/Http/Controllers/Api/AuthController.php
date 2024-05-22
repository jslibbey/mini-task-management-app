<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        abort_if(!auth()->validate($credentials = $request->validated()), 404, __('auth.failed'));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return UserResource::make(auth('sanctum')->user());
        }
    }

    /**
     * Register user
     */
    public function register(RegisterRequest $request)
    {
        $name = substr($request->email, 0, strpos($request->email, '@'));

        User::create([
            'name' => $name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        return response(json_encode([
            'success' => true
        ]));
    }
}
