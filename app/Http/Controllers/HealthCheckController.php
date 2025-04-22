<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
    public function index()
    {
        $cpuLoad = $this->getCpuLoad();
        $memoryUsage = memory_get_usage(true);
        $memoryLimit = ini_get('memory_limit');

        return view('health', [
            'cpuLoad' => $cpuLoad,
            'memoryUsage' => $this->formatBytes($memoryUsage),
            'memoryLimit' => $memoryLimit,
        ]);
    }

    private function getCpuLoad()
    {
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            return $load[0];
        }

        // Fallback if not supported
        return 'N/A';
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
    }
}
