<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Web\PaymentController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function ($router){
    $router->post('/register', [AuthController::class, 'register']);
    $router->post('/login', [AuthController::class, 'login']);

    $router->post('/pay',[PaymentController::class,'pay'])->name('pay.request');
});
