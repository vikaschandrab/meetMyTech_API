<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    /**
     * Format date for display
     */
    public static function formatDate(?string $date, string $format = 'M d, Y'): string
    {
        if (!$date) {
            return 'N/A';
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return 'Invalid Date';
        }
    }

    /**
     * Format date with time for display
     */
    public static function formatDateTime(?string $date, string $format = 'M d, Y \a\t g:i A'): string
    {
        if (!$date) {
            return 'N/A';
        }

        try {
            return Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return 'Invalid Date';
        }
    }

    /**
     * Format number with commas
     */
    public static function formatNumber(int $number): string
    {
        return number_format($number);
    }

    /**
     * Format file size in human readable format
     */
    public static function formatFileSize(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Truncate text with ellipsis
     */
    public static function truncate(string $text, int $limit = 100, string $end = '...'): string
    {
        if (strlen($text) <= $limit) {
            return $text;
        }

        return substr($text, 0, $limit) . $end;
    }

    /**
     * Format user status with badge
     */
    public static function formatUserStatus(string $status): string
    {
        $badges = [
            'active' => '<span class="badge badge-success">Active</span>',
            'inactive' => '<span class="badge badge-secondary">Inactive</span>',
            'suspended' => '<span class="badge badge-danger">Suspended</span>',
            'pending' => '<span class="badge badge-warning">Pending</span>',
        ];

        return $badges[$status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    /**
     * Format blog status with badge
     */
    public static function formatBlogStatus(string $status): string
    {
        $badges = [
            'published' => '<span class="badge badge-success">Published</span>',
            'draft' => '<span class="badge badge-secondary">Draft</span>',
            'archived' => '<span class="badge badge-warning">Archived</span>',
        ];

        return $badges[$status] ?? '<span class="badge badge-secondary">Unknown</span>';
    }

    /**
     * Get time ago format
     */
    public static function timeAgo(?string $date): string
    {
        if (!$date) {
            return 'N/A';
        }

        try {
            return Carbon::parse($date)->diffForHumans();
        } catch (\Exception $e) {
            return 'Invalid Date';
        }
    }
}
