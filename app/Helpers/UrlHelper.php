<?php

namespace App\Helpers;

class UrlHelper
{
    /**
     * Generate subdomain URL for user profile
     *
     * @param string $slug
     * @param bool $secure
     * @return string
     */
    public static function profileSubdomain($slug, $secure = true)
    {
        $protocol = $secure ? 'https://' : 'http://';
        $domain = env('APP_DOMAIN', 'meetmytech.com');

        return $protocol . $slug . '.' . $domain;
    }

    /**
     * Check if current request is from subdomain
     *
     * @return bool
     */
    public static function isSubdomain()
    {
        $host = request()->getHost();
        $parts = explode('.', $host);

        // If we have more than 2 parts and first part is not www
        return count($parts) > 2 && $parts[0] !== 'www';
    }

    /**
     * Get subdomain from current request
     *
     * @return string|null
     */
    public static function getSubdomain()
    {
        $host = request()->getHost();
        $parts = explode('.', $host);

        if (count($parts) > 2 && $parts[0] !== 'www') {
            return $parts[0];
        }

        return null;
    }
}
