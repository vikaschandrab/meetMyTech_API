<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DatabaseBackup extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Take daily DB backup and store in storage/backups';

    public function handle()
    {
        $connection = config('database.default');
        $db = config("database.connections.$connection.database");
        $user = config("database.connections.$connection.username");
        $pass = config("database.connections.$connection.password");
        $host = config("database.connections.$connection.host");

        $date = Carbon::now()->format('Y-m-d_H-i-s');
        $fileName = storage_path("app/backups/backup_{$date}.sql");

        // Ensure backups folder exists
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        // mysqldump command
        $mysqldumpPath = "C:/xampp/mysql/bin/mysqldump.exe";
        $command = "\"{$mysqldumpPath}\" --user={$user} --password={$pass} --host={$host} {$db} > \"{$fileName}\"";

        $returnVar = null;
        $output = null;

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            Log::info("Database backup successful: {$fileName}");
            $this->info("Database backup successful: {$fileName}");
        } else {
            Log::error("Database backup failed!");
            $this->error("Database backup failed!");
        }

        return 0;
    }
}
