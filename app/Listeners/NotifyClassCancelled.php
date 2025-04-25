<?php

namespace App\Listeners;

use App\Events\ClassCancelled;
use App\Mail\ClassCancelledMail;
use Illuminate\Support\Facades\Log;
use App\Jobs\NotifyClassCanceledJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyClassCancelled
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ClassCancelled $event): void
    {
        $members = $event->scheduleClass->members()->get();
        $className = $event->scheduleClass->classType->name;
        $classDateTime =  $event->scheduleClass->date_time;
        $details = compact('className', 'classDateTime');
        NotifyClassCanceledJob::dispatch($members, $details);
        

        // Send email to each member
        // $members->each(function ($user) use ($details) {
        //     Mail::to($user)->send(new ClassCancelledMail($details));
        // });
        //Log::info('Class cancelled: ' . $scheduleClass);
    }
}
