<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LoggingService
{
    /**
     * Log authentication activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logAuth(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('authentication')->info($message, $logContext);
    }

    /**
     * Log profile activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logProfile(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('profile')->info($message, $logContext);
    }

    /**
     * Log blog activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logBlog(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('blog')->info($message, $logContext);
    }

    /**
     * Log dashboard activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logDashboard(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('dashboard')->info($message, $logContext);
    }

    /**
     * Log education activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logEducation(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('education')->info($message, $logContext);
    }

    /**
     * Log experience activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logExperience(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('experience')->info($message, $logContext);
    }

    /**
     * Log site settings activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logSiteSettings(string $action, string $message, array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('site_settings')->info($message, $logContext);
    }

    /**
     * Log API activities
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logApi(string $action, string $message, array $context = []): void
    {
        $logContext = array_merge([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'method' => request()->method(),
            'url' => request()->fullUrl(),
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('api')->info($message, $logContext);
    }

    /**
     * Log security events
     *
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logSecurity(string $level, string $message, array $context = []): void
    {
        $logContext = array_merge([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('security')->{$level}($message, $logContext);
    }

    /**
     * Log database operations
     *
     * @param string $action
     * @param string $message
     * @param array $context
     * @return void
     */
    public static function logDatabase(string $action, string $message, array $context = []): void
    {
        $logContext = array_merge([
            'action' => $action,
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel('database')->info($message, $logContext);
    }

    /**
     * Log errors with appropriate context
     *
     * @param \Exception $exception
     * @param string $channel
     * @param array $context
     * @return void
     */
    public static function logError(\Exception $exception, string $channel = 'single', array $context = []): void
    {
        $user = Auth::user();
        $logContext = array_merge([
            'user_id' => $user?->id,
            'user_email' => $user?->email,
            'ip_address' => request()->ip(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'exception_class' => get_class($exception),
            'exception_message' => $exception->getMessage(),
            'exception_file' => $exception->getFile(),
            'exception_line' => $exception->getLine(),
            'timestamp' => now()->toISOString(),
        ], $context);

        Log::channel($channel)->error('Exception occurred: ' . $exception->getMessage(), $logContext);
    }
}
