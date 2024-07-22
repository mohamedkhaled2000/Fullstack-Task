<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(LoginRequest $request)
    {
        $user = $request->authenticate();

        $token = $user->createToken('authToken')->plainTextToken;

        return $this->successResponse([
            'token' => $token,
            'user'  => new UserResource($user)
        ]);
    }
}
