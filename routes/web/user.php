<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function ($route) {

    $route->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.user');

    $route->get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    $route->patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    $route->get('/profile/referral',[ProfileController::class,'referral'])->name('referral.show');
    $route->post('/profile/avatar',[ProfileController::class,'uploadAvatar'])->name('avatar.upload');

    $route->get('/private-photo/{filename}', [ProfileController::class, 'showFiles'])->name('private.image.show');
    $route->get('/private/{filename}', [ProfileController::class, 'showFile'])->name('private.images');
});
