<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RemindMembersNotification;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind members to book the class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = User::select('name', 'email')->where('role', 'member')
            ->whereDoesntHave('bookings', function($query){ 
                $query->where('date_time', '>', now()); 
            })->get();
        
        Notification::send($members, new RemindMembersNotification());
        
        //$this->table(['Name', 'Email'], $members->toArray());
    }
}
