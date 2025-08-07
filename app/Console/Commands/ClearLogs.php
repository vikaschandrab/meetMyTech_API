<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ClearLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear
                            {channel? : The log channel to clear (or all)}
                            {--older-than=30 : Clear logs older than X days}
                            {--force : Force deletion without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application logs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $channel = $this->argument('channel');
        $olderThan = $this->option('older-than');
        $force = $this->option('force');

        $logsPath = storage_path('logs');

        if ($channel && $channel !== 'all') {
            $this->clearSpecificChannel($channel, $olderThan, $force);
        } else {
            $this->clearAllChannels($olderThan, $force);
        }

        return Command::SUCCESS;
    }

    /**
     * Clear specific log channel
     *
     * @param string $channel
     * @param int $olderThan
     * @param bool $force
     */
    private function clearSpecificChannel(string $channel, int $olderThan, bool $force): void
    {
        $pattern = storage_path("logs/{$channel}*.log");
        $files = File::glob($pattern);

        if (empty($files)) {
            $this->error("No log files found for channel: {$channel}");
            return;
        }

        $this->clearLogFiles($files, $olderThan, $force, $channel);
    }

    /**
     * Clear all log channels
     *
     * @param int $olderThan
     * @param bool $force
     */
    private function clearAllChannels(int $olderThan, bool $force): void
    {
        $files = File::glob(storage_path('logs/*.log'));
        $this->clearLogFiles($files, $olderThan, $force, 'all channels');
    }

    /**
     * Clear log files
     *
     * @param array $files
     * @param int $olderThan
     * @param bool $force
     * @param string $description
     */
    private function clearLogFiles(array $files, int $olderThan, bool $force, string $description): void
    {
        $cutoffDate = Carbon::now()->subDays($olderThan);
        $filesToDelete = [];

        foreach ($files as $file) {
            $fileDate = Carbon::createFromTimestamp(File::lastModified($file));
            if ($fileDate->lt($cutoffDate)) {
                $filesToDelete[] = $file;
            }
        }

        if (empty($filesToDelete)) {
            $this->info("No log files older than {$olderThan} days found for {$description}.");
            return;
        }

        $this->info("Found " . count($filesToDelete) . " log files older than {$olderThan} days for {$description}:");
        foreach ($filesToDelete as $file) {
            $this->line("  - " . basename($file));
        }

        if (!$force && !$this->confirm('Do you want to delete these files?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $deleted = 0;
        foreach ($filesToDelete as $file) {
            if (File::delete($file)) {
                $deleted++;
            }
        }

        $this->info("Successfully deleted {$deleted} log files.");
    }
}
