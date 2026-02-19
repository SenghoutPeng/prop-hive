<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        \Log::info('Login method called', ['request' => $request->all()]);
        $credentials = $request->validate([
            'user_email' => 'required|email',
            'password' => 'required',
        ]);

        \Log::info('Login attempt', $credentials);
        $user = \App\Models\User::where('user_email', $credentials['user_email'])->first();
        \Log::info('User found', ['user' => $user]);
        if ($user) {
            \Log::info('Password check', [
                'input' => $credentials['password'],
                'db' => $user->user_password,
                'match' => \Hash::check($credentials['password'], $user->user_password)
            ]);
        }

        if (\Auth::attempt(['user_email' => $credentials['user_email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'user_email' => 'The provided credentials do not match our records.',
        ])->onlyInput('user_email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect('/');
    }
} 