<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\LoggingService;

class AuthController extends Controller
{

    public function index(){
        LoggingService::logAuth('login_page_view', 'User viewed login page');
        return view('Users.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        LoggingService::logAuth('login_attempt', 'User attempting to login', [
            'email' => $request->email
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check user_type
            if ($user->user_type !== 'user') {
                Auth::logout(); // logout immediately

                LoggingService::logSecurity('warning', 'Unauthorized user type attempted login', [
                    'email' => $request->email,
                    'user_type' => $user->user_type
                ]);

                return redirect()->back()->withErrors(['email' => 'Unauthorized user type.']);
            }

            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            LoggingService::logAuth('login_success', 'User successfully logged in', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // Add success message
            session()->flash('message', 'Welcome back! You have been successfully logged in.');
            session()->flash('message_type', 'success');

            return redirect()->intended('/dashboard'); // or your target route
        }

        // If login failed
        LoggingService::logSecurity('warning', 'Failed login attempt', [
            'email' => $request->email,
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        LoggingService::logAuth('logout', 'User logged out', [
            'user_id' => $user?->id,
            'email' => $user?->email
        ]);

        Auth::logout(); // logs out the user

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }
}

