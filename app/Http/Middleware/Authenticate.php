<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // For API routes, AJAX, or explicit JSON requests, return null to send JSON response
            if ($request->is('api/*') || $request->wantsJson() || $request->ajax()) {
                return null;
            }
            
            // Store the intended URL so user can be redirected back after login
            session(['url.intended' => $request->url()]);
            
            // Add a flash message to show why they were redirected
            session()->flash('message', 'Please login to view this page.');
            session()->flash('message_type', 'info');
            
            return route('login');
        }
    }
}
