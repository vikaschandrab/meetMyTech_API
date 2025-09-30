<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;

class DatabaseBackup extends Command
{
    protected $signature = 'backup:db';
    protected $description = 'Take daily DB backup, zip it and email to admin';

    protected $adminEmail = 'admin@meetmytech.com';

    protected function findMysqldump()
    {
        // For Linux/Unix systems, try common paths first
        if (PHP_OS !== 'WINNT') {
            $paths = [
                '/usr/bin/mysqldump',
                '/usr/local/bin/mysqldump',
                '/usr/local/mysql/bin/mysqldump',
                '/opt/mysql/bin/mysqldump'
            ];
        } else {
            // For Windows systems
            $paths = [
                "C:/xampp/mysql/bin/mysqldump.exe",
                "C:/wamp64/bin/mysql/mysql8.0.31/bin/mysqldump.exe",
                "C:/Program Files/MySQL/MySQL Server 8.0/bin/mysqldump.exe"
            ];
        }

        // Add system PATH check
        $paths[] = 'mysqldump' . (PHP_OS === 'WINNT' ? '.exe' : '');

        // Check each path
        foreach ($paths as $path) {
            if (PHP_OS === 'WINNT') {
                if (file_exists($path)) {
                    return $path;
                }
            } else {
                // For Unix systems, use which command
                $command = "which " . basename($path) . " 2>/dev/null";
                exec($command, $output, $returnVar);
                if ($returnVar === 0 && !empty($output[0])) {
                    return $output[0];
                }
            }
        }

        throw new \Exception("mysqldump executable not found. Please ensure MySQL is installed and mysqldump is in the system PATH.");
    }

    protected function testDatabaseConnection($host, $user, $pass, $db)
    {
        try {
            $dsn = "mysql:host={$host};dbname={$db}";
            new \PDO($dsn, $user, $pass);
            return true;
        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function handle()
    {
        try {
            $connection = config('database.default');
            $db = config("database.connections.$connection.database");
            $user = config("database.connections.$connection.username");
            $pass = config("database.connections.$connection.password");
            $host = config("database.connections.$connection.host");

            // Validate database connection
            $this->testDatabaseConnection($host, $user, $pass, $db);

            // Use fixed filenames for daily overwrite
            $sqlFile = storage_path("app/backups/daily_backup.sql");
            $zipFile = storage_path("app/backups/daily_backup.zip");

            // Ensure backups folder exists and is writable
            $backupPath = storage_path('app/backups');
            if (!file_exists($backupPath)) {
                if (!mkdir($backupPath, 0755, true)) {
                    throw new \Exception("Failed to create backup directory: " . $backupPath);
                }
            } elseif (!is_writable($backupPath)) {
                throw new \Exception("Backup directory is not writable: " . $backupPath);
            }

            // Find mysqldump executable
            $mysqldumpPath = $this->findMysqldump();

            // Construct and execute mysqldump command
            if (PHP_OS === 'WINNT') {
                $command = "\"{$mysqldumpPath}\" --user={$user} --password={$pass} --host={$host} --single-transaction --routines --triggers {$db} 2>&1 > \"{$sqlFile}\"";
            } else {
                // For Unix systems, use proper escaping
                $command = sprintf(
                    '%s --user=%s --password=%s --host=%s --single-transaction --routines --triggers %s 2>&1 > %s',
                    escapeshellcmd($mysqldumpPath),
                    escapeshellarg($user),
                    escapeshellarg($pass),
                    escapeshellarg($host),
                    escapeshellarg($db),
                    escapeshellarg($sqlFile)
                );
            }

            $output = [];
            $returnVar = null;

            // On Unix systems, use bash to execute the command
            if (PHP_OS !== 'WINNT') {
                $command = '/bin/bash -c ' . escapeshellarg($command);
            }

            exec($command, $output, $returnVar);

            if ($returnVar === 0) {
                // Create zip file
                if ($this->createZipBackup($sqlFile, $zipFile)) {
                    // Send success email with zip attachment
                    $this->sendSuccessEmail($zipFile);
                    Log::info("Database backup successful and emailed to admin");
                    $this->info("Database backup successful and emailed to admin");
                } else {
                    throw new \Exception("Failed to create zip file");
                }
            } else {
                throw new \Exception(implode("\n", $output) ?: "Database backup command failed");
            }

            // Clean up SQL file after zip is created
            if (file_exists($sqlFile)) {
                unlink($sqlFile);
            }

        } catch (\Exception $e) {
            $this->sendFailureEmail($e->getMessage());
            Log::error("Database backup failed: " . $e->getMessage());
            $this->error("Database backup failed!");
        }

        return 0;
    }

    protected function createZipBackup($sqlFile, $zipFile)
    {
        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            $zip->addFile($sqlFile, basename($sqlFile));
            $zip->close();
            return true;
        }
        return false;
    }

    protected function validateEmailConfig()
    {
        $config = [
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'password' => config('mail.mailers.smtp.password'),
            'from_address' => config('mail.from.address')
        ];

        $missing = [];
        foreach ($config as $key => $value) {
            if (empty($value)) {
                $missing[] = strtoupper("MAIL_" . $key);
            }
        }

        if (!empty($missing)) {
            // Log the current configuration for debugging
            Log::debug("Current mail configuration:", [
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from_name' => config('mail.from.name'),
                'from_address' => config('mail.from.address')
            ]);

            throw new \Exception("Missing email configuration: " . implode(', ', $missing));
        }

        return true;
    }

    protected function logBackupToFile($message, $isError = false)
    {
        $logFile = storage_path('logs/backup.log');
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $type = $isError ? 'ERROR' : 'INFO';
        file_put_contents($logFile, "[{$date}] {$type}: {$message}" . PHP_EOL, FILE_APPEND);
    }

    protected function sendSuccessEmail($zipFile)
    {
        try {
            $this->validateEmailConfig();

            if (!file_exists($zipFile)) {
                throw new \Exception("Backup zip file not found: " . $zipFile);
            }

            Mail::send('emails.backup-success', [
                'date' => Carbon::now()->format('Y-m-d H:i:s')
            ], function ($message) use ($zipFile) {
                $message->to($this->adminEmail)
                        ->subject('Database Backup Success - ' . Carbon::now()->format('Y-m-d'))
                        ->attach($zipFile);
            });

            $this->logBackupToFile("Success email sent to {$this->adminEmail}");
            $this->info("Backup successful and email sent to admin");
        } catch (\Exception $e) {
            $this->logBackupToFile("Failed to send success email: " . $e->getMessage(), true);
            // Don't throw the error, just log it
            $this->warn("Backup successful but email sending failed: " . $e->getMessage());
        }
    }

    protected function sendFailureEmail($errorMessage)
    {
        try {
            $this->validateEmailConfig();

            $systemInfo = [
                'PHP Version' => PHP_VERSION,
                'Laravel Version' => app()->version(),
                'Environment' => config('app.env'),
                'Database' => config('database.default'),
                'Mail Driver' => config('mail.default'),
                'Mail Host' => config('mail.mailers.smtp.host'),
                'Mail Port' => config('mail.mailers.smtp.port')
            ];

            $pdf = PDF::loadView('emails.backup-failure-pdf', [
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'error' => $errorMessage,
                'system_info' => $systemInfo
            ]);

            Mail::send('emails.backup-failure', [
                'date' => Carbon::now()->format('Y-m-d H:i:s'),
                'error' => $errorMessage
            ], function ($message) use ($pdf) {
                $message->to($this->adminEmail)
                        ->subject('Database Backup Failed - ' . Carbon::now()->format('Y-m-d'))
                        ->attachData($pdf->output(), 'backup-error-report.pdf');
            });

            $this->logBackupToFile("Failure notification sent to {$this->adminEmail}");
            $this->error("Backup failed and notification sent to admin");
        } catch (\Exception $e) {
            $this->logBackupToFile("Failed to send failure notification: " . $e->getMessage(), true);
            Log::error("Backup failed. Additionally, failure notification could not be sent: " . $e->getMessage());
            $this->error("Backup failed and notification email failed to send");
        }
    }
}
