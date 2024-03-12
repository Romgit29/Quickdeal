<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthApiService;

class AuthApiController extends Controller
{
    public function login(LoginRequest $request) {
        $result = AuthApiService::login($request);
        if(!$result)  {
            return response()->json([
                'message' => 'Access error'
            ], 403);
        } else {
            return response()->json([
                'token' => $result
            ]);   
        }
    }
}
