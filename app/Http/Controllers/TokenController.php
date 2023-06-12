<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(UserToken::class, 'token');
    }

    public function index()
    {
        return response()->json([
            'success' => true,
            'user' => UserResource::make(Auth::guard('custom_token')->user()->load('accessTokens')),
        ]);
    }

    public function store()
    {
        Auth::guard('custom_token')->user()->accessTokens()->create([]);

        return response()->json([
            'success' => true,
            'user' => UserResource::make(Auth::guard('custom_token')->user()->load('accessTokens')),
        ]);
    }

    public function destroy(UserToken $token)
    {
        $token->delete();

        return response()->json([
            'success' => true,
            'message' => 'token has been deleted.',
            'user' => UserResource::make(Auth::guard('custom_token')->user()->load('accessTokens')),
        ]);
    }
}
