<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function index(){
        return view('Users.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check user_type
            if ($user->user_type !== 'user') {
                Auth::logout(); // logout immediately
                return redirect()->back()->withErrors(['email' => 'Unauthorized user type.']);
            }

            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            return redirect()->intended('/dashboard'); // or your target route
        }

        // If login failed
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logs out the user

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}

