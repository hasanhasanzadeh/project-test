<?php

use App\Models\Cost;
use App\Notifications\UserNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {

    $costs = Cost::where('status', 'pending')->update(['status' => 'accept']);

    foreach ($costs as $cost) {
        $message = ' وضعیت درخواست به حالت پذیرش تغییر کرد';
        $cost->user->notify(new UserNotification($message, 'تغییر وضعیت درخواست پرداخت', 'email'));
    }
})->dailyAt('12:00');
