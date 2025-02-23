<?php

namespace App\Helpers;

use App\Models\Cost;
use App\Models\User;

class DashboardPanel
{

    public static function dashboard()
    {
        $userCount = User::all()->count();
        $userToday = User::whereDate('created_at', today())->count();
        $paymentToday = Cost::whereDate('created_at', today())->where('status', 'done')->sum('amount');
        $paymentCount = Cost::where('status', 'done')->count();
        $requestPaymentToday = Cost::where('status', 'pending')->count();
        return [
            'userCount' => $userCount,
            'userToday' => $userToday,
            'paymentToday' => $paymentToday,
            'paymentCount' => $paymentCount,
            'requestPaymentToday' => $requestPaymentToday,
        ];
    }

}
