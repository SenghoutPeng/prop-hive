<?php

namespace App\Http\Controllers\FrontEndController;

use App\Http\Controllers\Controller;
use App\Models\FrontendModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'user_email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('user_email', $credentials['user_email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->user_password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The provided credentials do not match our records.'
                ], 401);
            }

            if (Hash::check($credentials['password'], $user->user_password)) {
                // For API, we'll use Sanctum tokens instead of session
                $token = $user->createToken('auth-token')->plainTextToken;

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'user' => [
                            'id' => $user->user_id,
                            'name' => $user->user_name,
                            'email' => $user->user_email,
                            'phone' => $user->user_phone,
                            'profile_picture' => $user->user_profile_picture,
                            'is_admin' => $user->is_admin
                        ],
                        'token' => $token
                    ]
                ]);
            }

            Log::warning('Unexpected auth flow reached', ['user_email' => $credentials['user_email']]);
            return response()->json([
                'success' => false,
                'message' => 'Login failed'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Revoke the token
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showRegistrationForm()
    {
        return response()->json([
            'success' => true,
            'message' => 'Registration form data',
            'data' => [
                'title' => 'Register',
                'description' => 'Create a new account'
            ]
        ]);
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user,user_email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'user_name' => $request->name,
                'user_email' => $request->email,
                'user_password' => Hash::make($request->password),
            ]);

            // Create token for the new user
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'data' => [
                    'user' => [
                        'id' => $user->user_id,
                        'name' => $user->user_name,
                        'email' => $user->user_email,
                        'is_admin' => $user->is_admin
                    ],
                    'token' => $token
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
