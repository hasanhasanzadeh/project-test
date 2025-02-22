<?php


use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function ($router) {
    $router->get('/profile',[AuthController::class, 'profile']);
    $router->post('/logout', [AuthController::class, 'logout']);

    $router->post('/send-notification', [NotificationController::class, 'sendNotification']);
});
