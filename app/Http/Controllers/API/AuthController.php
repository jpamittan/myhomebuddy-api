<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Mail\ActivateAccount;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function me()
    {
        return response()->json([
                'data' => auth()->user()
            ],
            200
        );
    }

    public function login(Request $request): ?object
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $token = JWTAuth::attempt($credentials);
            if(!$token) {
                return response()->json(['error' => "Invalid credentials."], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer'
            ], 
            200
        );
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
                'message' => 'Successfully logged out.'
            ],
            200
        );
    }
}
