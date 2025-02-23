<?php

use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CostController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function ($route) {

    $route->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.user');

    $route->resource('/payments',CostController::class);
    $route->get('/category/search',[CategoryController::class,'search'])->name('category.search');

    $route->get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    $route->patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    $route->get('/profile/referral',[ProfileController::class,'referral'])->name('referral.show');
    $route->post('/profile/avatar',[ProfileController::class,'uploadAvatar'])->name('avatar.upload');

    $route->get('/private-photo/{filename}', [CostController::class, 'showFiles'])->name('private.image.show');
    $route->get('/private/{filename}', [ProfileController::class, 'showFile'])->name('private.images');
});
