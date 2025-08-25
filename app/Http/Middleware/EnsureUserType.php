<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type === 'user') {
            // Check if user account is active
            if (Auth::user()->status !== 'active') {
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'Your account is inactive. Please contact support.']);
            }
            return $next($request);
        }

        // If admin user tries to access regular dashboard, redirect to admin panel
        if (Auth::check() && Auth::user()->user_type === 'admin') {
            return redirect()->route('admin.dashboard')->with('info', 'Redirected to Admin Panel.');
        }

        return redirect('/login')->withErrors(['email' => 'Unauthorized user type.']);
    }
}
