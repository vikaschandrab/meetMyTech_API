<?php

namespace App\Actions\Admin;

use Illuminate\Http\Request;

class ProcessSystemLogsAction
{
    public function execute(Request $request): array
    {
        $logsPath = storage_path('logs');
        $activityFilter = $request->get('activity', 'all');
        $dateFilter = $request->get('date', 'all');

        $logFiles = glob($logsPath . '/*.log');
        $customLogs = [];
        $activities = [];

        foreach ($logFiles as $file) {
            $filename = basename($file);

            // Skip laravel.log as it's the default log
            if ($filename === 'laravel.log') {
                continue;
            }

            // Extract activity name and date from filename
            if (preg_match('/^(.+)-(\d{4}-\d{2}-\d{2})\.log$/', $filename, $matches)) {
                $activityName = $matches[1];
                $logDate = $matches[2];

                // Add to activities list for filter
                if (!in_array($activityName, $activities)) {
                    $activities[] = $activityName;
                }

                // Apply filters
                if ($activityFilter !== 'all' && $activityFilter !== $activityName) {
                    continue;
                }

                if ($dateFilter !== 'all' && $dateFilter !== $logDate) {
                    continue;
                }

                // Read log file content
                if (file_exists($file) && is_readable($file)) {
                    $content = file_get_contents($file);
                    $lines = array_filter(explode("\n", $content));

                    // Parse log entries
                    $logEntries = $this->parseLogEntries($lines);

                    if (!empty($logEntries)) {
                        $customLogs[] = [
                            'activity' => $activityName,
                            'date' => $logDate,
                            'filename' => $filename,
                            'entries' => $logEntries,
                            'total_entries' => count($logEntries)
                        ];
                    }
                }
            }
        }

        // Sort by date desc, then by activity name
        usort($customLogs, function($a, $b) {
            $dateCompare = strcmp($b['date'], $a['date']);
            if ($dateCompare === 0) {
                return strcmp($a['activity'], $b['activity']);
            }
            return $dateCompare;
        });

        return [
            'customLogs' => $customLogs,
            'activities' => $activities,
            'currentActivity' => $activityFilter,
            'currentDate' => $dateFilter,
            'totalLogFiles' => count($customLogs),
            'totalEntries' => array_sum(array_column($customLogs, 'total_entries'))
        ];
    }

    private function parseLogEntries(array $lines): array
    {
        $entries = [];

        foreach ($lines as $line) {
            if (empty(trim($line))) continue;

            // Parse Laravel log format: [timestamp] level: message context
            if (preg_match('/^\[([^\]]+)\]\s+(\w+):\s+(.+)$/', $line, $matches)) {
                $timestamp = $matches[1];
                $level = $matches[2];
                $message = $matches[3];

                // Try to extract context if it exists
                $context = '';
                if (strpos($message, ' {"') !== false) {
                    $parts = explode(' {"', $message, 2);
                    $message = $parts[0];
                    $context = '{"' . $parts[1];
                }

                $entries[] = [
                    'timestamp' => $timestamp,
                    'level' => strtolower($level),
                    'message' => $message,
                    'context' => $context,
                    'raw' => $line
                ];
            } else {
                // Handle malformed lines
                $entries[] = [
                    'timestamp' => date('Y-m-d H:i:s'),
                    'level' => 'info',
                    'message' => $line,
                    'context' => '',
                    'raw' => $line
                ];
            }
        }

        return array_reverse($entries); // Latest first
    }

    public function getActivityIcon(string $activity): string
    {
        $icons = [
            'authentication' => 'fas fa-sign-in-alt',
            'blog' => 'fas fa-blog',
            'profile' => 'fas fa-user',
            'dashboard' => 'fas fa-tachometer-alt',
            'activity' => 'fas fa-chart-line',
            'education' => 'fas fa-graduation-cap',
            'experience' => 'fas fa-briefcase',
            'settings' => 'fas fa-cog',
            'contact' => 'fas fa-envelope',
        ];

        return $icons[$activity] ?? 'fas fa-file-alt';
    }

    public function getActivityColor(string $activity): string
    {
        $colors = [
            'authentication' => 'success',
            'blog' => 'primary',
            'profile' => 'info',
            'dashboard' => 'warning',
            'activity' => 'secondary',
            'education' => 'purple',
            'experience' => 'orange',
            'settings' => 'dark',
            'contact' => 'teal',
        ];

        return $colors[$activity] ?? 'secondary';
    }
}
