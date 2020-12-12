<?php

namespace Stub\App;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;
use Stub\Support\Playbooks\PlaybookRunCommand;

class ConsoleKernel extends Kernel
{
    protected $commands = [
        PlaybookRunCommand::class
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
