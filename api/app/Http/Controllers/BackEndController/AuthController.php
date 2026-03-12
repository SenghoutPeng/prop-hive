<?php

namespace App\Http\Controllers\BackEndController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\BackendModel\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Handle login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'user_email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $user = User::where('user_email', $request->input('user_email'))->first();

            if ($user && Hash::check($request->input('password'), $user->user_password)) {

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

            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Handle logout
   public function logout(Request $request)
{
    try {
        auth()->logout(); // logs out the current user
        $request->session()->invalidate(); // invalidate session
        $request->session()->regenerateToken(); // regenerate CSRF token

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
}
