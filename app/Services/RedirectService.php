<?php

namespace App\Services;

use Illuminate\Http\Request;

class RedirectService
{
    /**
     * Generate smart redirect URL after login/logout
     *
     * @param string $type The type of redirect (login, logout)
     * @return string
     */
    public static function getSmartRedirectUrl($type = 'login')
    {
        $redirectType = session('intended_redirect_type', 'all-blogs');

        // Clear the intended redirect session for login
        if ($type === 'login') {
            session()->forget(['intended_redirect_type', 'intended_subdomain']);
        }

        switch ($redirectType) {
            case 'profile':
                $subdomain = session('intended_subdomain');
                if ($subdomain) {
                    return self::buildSubdomainUrl($subdomain);
                }
                break;

            case 'home':
                return route('home');

            case 'all-blogs':
                return route('home.all-blogs');
        }

        // Default fallback
        return route('home.all-blogs');
    }

    /**
     * Store redirect information based on request
     *
     * @param Request $request
     * @return void
     */
    public static function storeRedirectInfo(Request $request)
    {
        $referrer = $request->headers->get('referer');

        if ($referrer) {
            // Parse the referrer URL
            $parsedUrl = parse_url($referrer);
            $host = $parsedUrl['host'] ?? '';
            $path = $parsedUrl['path'] ?? '/';

            // Check if coming from a subdomain profile
            if (self::isSubdomainProfile($host)) {
                session(['intended_redirect_type' => 'profile']);
                session(['intended_subdomain' => self::getSubdomainFromHost($host)]);
                return;
            }

            // Check if coming from specific pages
            if ($path === '/') {
                session(['intended_redirect_type' => 'home']);
                return;
            }

            if ($path === '/all-blogs') {
                session(['intended_redirect_type' => 'all-blogs']);
                return;
            }
        }

        // Check current request as fallback
        $currentHost = $request->getHost();
        $currentPath = $request->getPathInfo();

        if (self::isSubdomainProfile($currentHost)) {
            session(['intended_redirect_type' => 'profile']);
            session(['intended_subdomain' => self::getSubdomainFromHost($currentHost)]);
            return;
        }

        if ($currentPath === '/') {
            session(['intended_redirect_type' => 'home']);
            return;
        }

        if ($currentPath === '/all-blogs') {
            session(['intended_redirect_type' => 'all-blogs']);
            return;
        }

        // Default to all-blogs if no specific context
        session(['intended_redirect_type' => 'all-blogs']);
    }

    /**
     * Check if host is a subdomain profile
     *
     * @param string $host
     * @return bool
     */
    public static function isSubdomainProfile($host)
    {
        $appDomain = config('app.domain', 'meetmytech.com');
        $hostParts = explode('.', $host);
        $domainParts = explode('.', $appDomain);

        // If host has more parts than domain and ends with domain
        if (count($hostParts) > count($domainParts)) {
            $hostSuffix = implode('.', array_slice($hostParts, -count($domainParts)));
            return $hostSuffix === $appDomain && $hostParts[0] !== 'www';
        }

        return false;
    }

    /**
     * Extract subdomain from host
     *
     * @param string $host
     * @return string|null
     */
    public static function getSubdomainFromHost($host)
    {
        $appDomain = config('app.domain', 'meetmytech.com');
        $hostParts = explode('.', $host);
        $domainParts = explode('.', $appDomain);

        if (count($hostParts) > count($domainParts)) {
            return $hostParts[0];
        }

        return null;
    }

    /**
     * Build subdomain URL
     *
     * @param string $subdomain
     * @return string
     */
    public static function buildSubdomainUrl($subdomain)
    {
        $appDomain = config('app.domain', 'meetmytech.com');
        $protocol = (app()->environment('production') || config('app.force_https', false)) ? 'https' : 'http';

        return $protocol . '://' . $subdomain . '.' . $appDomain;
    }

    /**
     * Get login redirect URL with smart detection
     *
     * @param Request $request
     * @return string
     */
    public static function getLoginRedirectUrl(Request $request)
    {
        // Store redirect info first
        self::storeRedirectInfo($request);

        // Return the smart redirect URL
        return self::getSmartRedirectUrl('login');
    }

    /**
     * Get logout redirect URL with smart detection
     *
     * @param Request $request
     * @return string
     */
    public static function getLogoutRedirectUrl(Request $request)
    {
        // Store redirect info first
        self::storeRedirectInfo($request);

        // Return the smart redirect URL (don't clear session for logout)
        return self::getSmartRedirectUrl('logout');
    }

    /**
     * Get smart back URL for blog show page based on referrer
     *
     * @param Request $request
     * @param object $blog Blog model with user relationship
     * @return array ['url' => string, 'label' => string]
     */
    public static function getBlogBackUrl(Request $request, $blog)
    {
        $referrer = $request->headers->get('referer');

        if ($referrer) {
            // Parse the referrer URL
            $parsedUrl = parse_url($referrer);
            $host = $parsedUrl['host'] ?? '';
            $path = $parsedUrl['path'] ?? '/';

            // Check if coming from home page
            if ($path === '/') {
                return [
                    'url' => route('home'),
                    'label' => 'Back to Home'
                ];
            }

            // Check if coming from all-blogs page
            if ($path === '/all-blogs') {
                return [
                    'url' => route('home.all-blogs'),
                    'label' => 'Back to All Blogs'
                ];
            }

            // Check if coming from a subdomain profile
            if (self::isSubdomainProfile($host)) {
                $subdomain = self::getSubdomainFromHost($host);
                if ($subdomain) {
                    return [
                        'url' => self::buildSubdomainUrl($subdomain),
                        'label' => 'Back to ' . ucfirst($subdomain) . "'s Profile"
                    ];
                }
            }

            // Check if coming from the blog author's profile (main domain)
            if ($path === '/' . $blog->user->slug) {
                return [
                    'url' => '/' . $blog->user->slug,
                    'label' => 'Back to ' . $blog->user->name . "'s Profile"
                ];
            }
        }

        // Default fallback - go to all-blogs page
        return [
            'url' => route('home.all-blogs'),
            'label' => 'Back to All Blogs'
        ];
    }
}
