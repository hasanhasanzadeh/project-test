<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function ($route) {

    $route->get('intro', [RegisteredUserController::class, 'introduction'])->name('intro.show');

    $route->get('register', [RegisteredUserController::class, 'create'])->name('register');
    $route->post('register', [RegisteredUserController::class, 'store']);
    $route->get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    $route->post('login', [AuthenticatedSessionController::class, 'store']);
    $route->get('verify',[RegisteredUserController::class,'verifyRegister'])->name('verify.register');

    $route->get('verified-mobile',[AuthenticatedSessionController::class,'verify'])->name('verified.mobile');
    $route->get('verified-code',[AuthenticatedSessionController::class,'verifiedCode'])->name('verified.code');
    $route->get('verified-resend/code',[AuthenticatedSessionController::class,'resendVerifiedCode'])->name('verified.resend.code');

    $route->get('verify/code',[RegisteredUserController::class,'verifyMobile'])->name('verify.mobile');
    $route->get('resend/code',[RegisteredUserController::class,'resendVerifyCode'])->name('resend.code');

    Route::get('/password/forgot', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/forgot', [ForgotPasswordController::class, 'sendResetToken'])->name('password.send_otp');

    Route::get('/password/verify', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verify_otp_form');
    Route::post('/password/verify', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify_otp');

    Route::get('/password/reset', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset_form');
    Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

});

Route::middleware('auth')->group(function ($route) {
    $route->get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    $route->get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    $route->post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    $route->get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    $route->post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    $route->put('password', [PasswordController::class, 'update'])->name('password.update');
    $route->get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
