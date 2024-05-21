<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return UserResource|void
     */
    public function login(LoginRequest $request)
    {
        abort_if(!auth()->validate($credentials = $request->validated()), 404, __('auth.failed'));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return UserResource::make(auth('sanctum')->user());
        }
    }
}
