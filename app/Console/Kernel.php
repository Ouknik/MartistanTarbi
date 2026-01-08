<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        "App\Console\Commands\DbBackup"
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Database backup every 4 hours
        $schedule->command('db:backup')->everyFourHours();

        // Check for expiring subscriptions daily at 9 AM
        $schedule->command('subscriptions:check-expiring')
            ->dailyAt('09:00')
            ->timezone('Africa/Casablanca');

        // Check for expired subscriptions every hour
        $schedule->command('subscriptions:check-expired')
            ->hourly()
            ->between('8:00', '20:00');

        // Check for trial periods ending daily at 10 AM
        $schedule->command('tenants:check-trial-ending')
            ->dailyAt('10:00')
            ->timezone('Africa/Casablanca');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
