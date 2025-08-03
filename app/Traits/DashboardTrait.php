<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

trait DashboardTrait
{
    /**
     * Cache dashboard data for performance
     */
    protected function cacheDashboardData($key, $data, $minutes = 30)
    {
        $cacheKey = "dashboard.{$key}." . auth()->id();
        Cache::put($cacheKey, $data, now()->addMinutes($minutes));
        return $data;
    }

    /**
     * Get cached dashboard data
     */
    protected function getCachedDashboardData($key)
    {
        $cacheKey = "dashboard.{$key}." . auth()->id();
        return Cache::get($cacheKey);
    }

    /**
     * Format number for display
     */
    protected function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return number_format($number);
    }

    /**
     * Calculate percentage change
     */
    protected function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return round((($current - $previous) / $previous) * 100, 2);
    }

    /**
     * Get period dates
     */
    protected function getPeriodDates($period = 'month')
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'week':
                return [
                    'start' => $now->startOfWeek()->copy(),
                    'end' => $now->endOfWeek()->copy()
                ];
            case 'quarter':
                return [
                    'start' => $now->startOfQuarter()->copy(),
                    'end' => $now->endOfQuarter()->copy()
                ];
            case 'year':
                return [
                    'start' => $now->startOfYear()->copy(),
                    'end' => $now->endOfYear()->copy()
                ];
            default: // month
                return [
                    'start' => $now->startOfMonth()->copy(),
                    'end' => $now->endOfMonth()->copy()
                ];
        }
    }

    /**
     * Get trend indicator (up, down, stable)
     */
    protected function getTrendIndicator($percentageChange)
    {
        if ($percentageChange > 2) {
            return ['direction' => 'up', 'color' => 'success', 'icon' => 'trending-up'];
        } elseif ($percentageChange < -2) {
            return ['direction' => 'down', 'color' => 'danger', 'icon' => 'trending-down'];
        } else {
            return ['direction' => 'stable', 'color' => 'warning', 'icon' => 'minus'];
        }
    }

    /**
     * Generate chart colors
     */
    protected function getChartColors()
    {
        return [
            'primary' => '#007bff',
            'secondary' => '#6c757d',
            'success' => '#28a745',
            'info' => '#17a2b8',
            'warning' => '#ffc107',
            'danger' => '#dc3545',
            'light' => '#f8f9fa',
            'dark' => '#343a40'
        ];
    }

    /**
     * Validate dashboard filters
     */
    protected function validateDashboardFilters($filters)
    {
        $allowedPeriods = ['week', 'month', 'quarter', 'year'];
        
        return [
            'period' => in_array($filters['period'] ?? 'month', $allowedPeriods) 
                ? $filters['period'] 
                : 'month',
            'limit' => min(max(intval($filters['limit'] ?? 10), 1), 50)
        ];
    }
}
