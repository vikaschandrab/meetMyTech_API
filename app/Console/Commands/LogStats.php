<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class LogStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:stats {channel? : The log channel to analyze}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show statistics for application logs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $channel = $this->argument('channel');

        if ($channel) {
            $this->showChannelStats($channel);
        } else {
            $this->showAllChannelsStats();
        }

        return Command::SUCCESS;
    }

    /**
     * Show statistics for a specific channel
     *
     * @param string $channel
     */
    private function showChannelStats(string $channel): void
    {
        $pattern = storage_path("logs/{$channel}*.log");
        $files = File::glob($pattern);

        if (empty($files)) {
            $this->error("No log files found for channel: {$channel}");
            return;
        }

        $this->info("Statistics for channel: {$channel}");
        $this->line(str_repeat('-', 50));

        $totalSize = 0;
        $totalLines = 0;
        $levels = ['ERROR' => 0, 'WARNING' => 0, 'INFO' => 0, 'DEBUG' => 0];

        foreach ($files as $file) {
            $size = File::size($file);
            $totalSize += $size;

            $content = File::get($file);
            $lines = substr_count($content, "\n");
            $totalLines += $lines;

            // Count log levels
            foreach ($levels as $level => $count) {
                $levels[$level] += substr_count($content, ".{$level}:");
            }
        }

        $this->displayStats($files, $totalSize, $totalLines, $levels);
    }

    /**
     * Show statistics for all channels
     */
    private function showAllChannelsStats(): void
    {
        $logFiles = File::glob(storage_path('logs/*.log'));

        if (empty($logFiles)) {
            $this->error("No log files found.");
            return;
        }

        $this->info("Log Statistics Summary");
        $this->line(str_repeat('=', 80));

        $channels = [];
        foreach ($logFiles as $file) {
            $channel = basename($file, '.log');
            if (!isset($channels[$channel])) {
                $channels[$channel] = [
                    'files' => [],
                    'size' => 0,
                    'lines' => 0,
                    'levels' => ['ERROR' => 0, 'WARNING' => 0, 'INFO' => 0, 'DEBUG' => 0]
                ];
            }

            $channels[$channel]['files'][] = $file;
            $size = File::size($file);
            $channels[$channel]['size'] += $size;

            $content = File::get($file);
            $lines = substr_count($content, "\n");
            $channels[$channel]['lines'] += $lines;

            foreach ($channels[$channel]['levels'] as $level => $count) {
                $channels[$channel]['levels'][$level] += substr_count($content, ".{$level}:");
            }
        }

        $headers = ['Channel', 'Files', 'Size', 'Lines', 'Errors', 'Warnings', 'Info', 'Debug'];
        $rows = [];

        foreach ($channels as $channel => $data) {
            $rows[] = [
                $channel,
                count($data['files']),
                $this->formatBytes($data['size']),
                number_format($data['lines']),
                number_format($data['levels']['ERROR']),
                number_format($data['levels']['WARNING']),
                number_format($data['levels']['INFO']),
                number_format($data['levels']['DEBUG'])
            ];
        }

        $this->table($headers, $rows);
    }

    /**
     * Display statistics for a channel
     *
     * @param array $files
     * @param int $totalSize
     * @param int $totalLines
     * @param array $levels
     */
    private function displayStats(array $files, int $totalSize, int $totalLines, array $levels): void
    {
        $this->line("Files: " . count($files));
        $this->line("Total size: " . $this->formatBytes($totalSize));
        $this->line("Total lines: " . number_format($totalLines));
        $this->line("");

        $this->line("Log levels:");
        foreach ($levels as $level => $count) {
            $color = match($level) {
                'ERROR' => 'red',
                'WARNING' => 'yellow',
                'INFO' => 'green',
                'DEBUG' => 'blue',
                default => 'white'
            };
            $this->line("  <fg={$color}>{$level}: " . number_format($count) . "</>");
        }

        $this->line("");
        $this->line("Files:");
        foreach ($files as $file) {
            $fileDate = Carbon::createFromTimestamp(File::lastModified($file));
            $this->line("  - " . basename($file) . " (" . $this->formatBytes(File::size($file)) . ", modified: " . $fileDate->diffForHumans() . ")");
        }
    }

    /**
     * Format bytes to human readable format
     *
     * @param int $bytes
     * @return string
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}
