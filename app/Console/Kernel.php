<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        $schedule->command('message:weekly_finance')
            ->days([Schedule::MONDAY, Schedule::THURSDAY])
            ->hourly()
            ->between('23:00', '00:00');

        // ->everyMinute();

        $schedule->command('message:weekly_delivery')
            //->days([Schedule::MONDAY, Schedule::THURSDAY])
            ->hourly()
            ->between('23:00', '00:00');

        // ->everyMinute();

        $schedule->command('message:weekly_networkops')
            ->days([Schedule::MONDAY, Schedule::THURSDAY])
            ->hourly()
            ->between('23:00', '00:00');


        // ->everyMinute();

        $schedule->command('message:weekly_serviceops')
            ->days([Schedule::MONDAY, Schedule::THURSDAY])
            ->hourly()
            ->between('23:00', '00:00');

        // ->everyMinute();



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
