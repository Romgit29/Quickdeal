<?php

namespace App\Services;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthApiService {
    public static function login(LoginRequest $request): bool|string {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return false;
        }
        $user->tokens()->delete();
        $authToken = $user->createToken('auth-token')->plainTextToken;

        return $authToken;
    }
}