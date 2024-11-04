<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAPIController extends AppBaseController
{
    // Login method
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Revoke old tokens
            $user->tokens()->delete();

            // Create a new token
            $token = $user->createToken('AuthToken')->accessToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Logout method
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Revoke all tokens
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return response()->json(['message' => 'Logout successful']);
        }

        return response()->json(['error' => 'User not found'], 404);
    }
}
