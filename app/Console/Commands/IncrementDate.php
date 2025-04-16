<?php

namespace App\Console\Commands;

use App\Models\ScheduleClass;
use Illuminate\Console\Command;

class IncrementDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:increment-date {--days=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment all the schedule classes date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $scheduleClasses = ScheduleClass::latest('date_time')->get();
        $scheduleClasses->each(function($class)
        {
            $class->date_time = $class->date_time->addDays($this->option('days'));
            $class->save();
        });
    }
}
