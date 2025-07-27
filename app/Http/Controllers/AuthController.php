<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|max:15|regex:/^[A-Za-z0-9_]+$/|string|unique:users,username',
            'name' => 'required|string|min:5|max:15',
            'password' => 'required|string|min:4|confirmed',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('loginPage')->with('success', 'Registration successful!');
    }
    public function checkUsername(Request $request)
    {
        $username = $request->input('username');
        $user = Auth::user();

        if ($user && $user->username === $username) {
            return response()->json(['available' => null]);
        }

        $exists = User::where('username', $username)->exists();
        return response()->json(['available' => !$exists]);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $field = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->route('chat');
        }

        return back()->withErrors([
            'login' => 'Invalid email/username or password.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage');
    }
}
