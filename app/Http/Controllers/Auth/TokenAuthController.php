<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TokenAuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create(array_merge($data, ['password' => bcrypt($data['password'])]));

        $user->accessTokens()->create();

        return response()->json([
            'success' => true,
            'user' => UserResource::make($user->load('accessTokens')),
        ]);
    }

    public function login(): \Illuminate\Http\JsonResponse
    {
        if (Auth::guard('custom_token')->validate()) {
            // Authentication successful
            $user = Auth::guard('custom_token')->user();

            return response()->json([
                'user' => UserResource::make($user->load('accessTokens')),
            ]);
        } else {
            // Authentication failed
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'user' => UserResource::make(Auth::guard('custom_token')->user()->load('accessTokens')),
        ]);
    }
}
