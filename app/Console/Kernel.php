<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('tokens:revoke-expired')->daily();
        $schedule->command('backup:db')
            ->daily()
            ->onFailure(function () {
                \Log::error('Database backup failed in cron job.');
            })
            ->onSuccess(function () {
                \Log::info('Database backup completed successfully via cron job.');
            });
        // Clear logs every month
        $schedule->command('logs:clear')->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
