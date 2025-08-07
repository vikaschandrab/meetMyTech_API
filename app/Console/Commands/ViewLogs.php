<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ViewLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:view
                            {channel? : The log channel to view (authentication, profile, blog, dashboard, etc.)}
                            {--lines=50 : Number of lines to show}
                            {--follow : Follow the log file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View application logs by functionality';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $channel = $this->argument('channel') ?: 'laravel';
        $lines = $this->option('lines');
        $follow = $this->option('follow');

        $logPath = storage_path("logs/{$channel}.log");

        // Check if log file exists
        if (!File::exists($logPath)) {
            $this->error("Log file for channel '{$channel}' does not exist.");
            $this->info("Available log files:");

            $logFiles = File::glob(storage_path('logs/*.log'));
            foreach ($logFiles as $logFile) {
                $fileName = basename($logFile, '.log');
                $this->line("  - {$fileName}");
            }

            return Command::FAILURE;
        }

        $this->info("Viewing logs for channel: {$channel}");
        $this->info("Log file: {$logPath}");
        $this->line(str_repeat('-', 80));

        if ($follow) {
            $this->followLog($logPath);
        } else {
            $this->showLastLines($logPath, $lines);
        }

        return Command::SUCCESS;
    }

    /**
     * Show last N lines of log file
     *
     * @param string $logPath
     * @param int $lines
     */
    private function showLastLines(string $logPath, int $lines): void
    {
        $content = File::get($logPath);
        $logLines = explode("\n", $content);
        $lastLines = array_slice($logLines, -$lines);

        foreach ($lastLines as $line) {
            if (trim($line)) {
                $this->formatLogLine($line);
            }
        }
    }

    /**
     * Follow log file (similar to tail -f)
     *
     * @param string $logPath
     */
    private function followLog(string $logPath): void
    {
        $this->info("Following log file... Press Ctrl+C to stop.");

        $handle = fopen($logPath, 'r');
        fseek($handle, 0, SEEK_END);

        while (true) {
            $line = fgets($handle);
            if ($line) {
                $this->formatLogLine(trim($line));
            } else {
                usleep(100000); // Sleep for 0.1 seconds
            }
        }
    }

    /**
     * Format and colorize log line
     *
     * @param string $line
     */
    private function formatLogLine(string $line): void
    {
        if (empty(trim($line))) {
            return;
        }

        // Color code based on log level
        if (str_contains($line, '.ERROR:')) {
            $this->line("<fg=red>{$line}</>");
        } elseif (str_contains($line, '.WARNING:')) {
            $this->line("<fg=yellow>{$line}</>");
        } elseif (str_contains($line, '.INFO:')) {
            $this->line("<fg=green>{$line}</>");
        } elseif (str_contains($line, '.DEBUG:')) {
            $this->line("<fg=blue>{$line}</>");
        } else {
            $this->line($line);
        }
    }
}
