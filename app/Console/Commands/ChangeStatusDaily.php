<?php

namespace App\Console\Commands;

use App\Models\Cost;
use App\Notifications\UserNotification;
use Illuminate\Console\Command;

class ChangeStatusDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-status-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status daily at 12:00 PM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Update the status in your database
        $costs = Cost::where('status', 'pending')->update(['status' => 'accept']);

        foreach ($costs as $cost) {
            $message = ' وضعیت درخواست به حالت پذیرش تغییر کرد';
            $cost->user->notify(new UserNotification($message, 'تغییر وضعیت درخواست پرداخت', 'email'));
        }
        $this->info('Status changed successfully!');
    }
}
