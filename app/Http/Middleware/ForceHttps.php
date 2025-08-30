<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Only force HTTPS in production and when FORCE_HTTPS is enabled
        if (app()->environment('production') && config('app.force_https', false)) {
            if (!$request->isSecure()) {
                // Build the secure URL maintaining the subdomain
                $secureUrl = 'https://' . $request->getHost() . $request->getRequestUri();

                return redirect($secureUrl, 301);
            }
        }

        return $next($request);
    }
}
