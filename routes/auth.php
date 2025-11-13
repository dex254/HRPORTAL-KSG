<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReasonsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
           Route::get('/signin', [InventController::class, 'Inventlogin'])->name('invent');
                Route::post('/signin', [InventController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
Route::middleware('Invent.auth')->group(function () {
     Route::get('/home', [InventController::class, 'Dashboard'])->name('Invent.Dashboard');
     //logout post
     Route::get('/problem', [ReasonsController::class, 'problem'])->name('problem.solve');
Route::get('/innovation', [InventController::class, 'innovation'])->name('innovation');
Route::get('/confirmation', [InventController::class, 'confirmation'])->name('confirmation');
Route::get('/report', [InventController::class, 'report'])->name('report');
Route::get('/my-innovations', [InventController::class, 'myInnovations'])->name('my.innovations');
Route::put('/invent/profile/update', [ProfileController::class, 'updateProfile'])->name('invent.profile.update');
 Route::get('/invent/problem', [ReasonsController::class, 'problem'])->name('innovation.problem');

    // Store Step 1, 2, 3
    Route::post('/invent/innovation/step', [ReasonsController::class, 'storeStep'])->name('innovation.step.store');

    // Final submit (Step 4)
    Route::post('/invent/innovation/submit', [ReasonsController::class, 'submitAll'])->name('innovation.final.submit');

    // List all innovations
    Route::get('/invent/innovation/list', [ReasonsController::class, 'index'])->name('innovation.list');


Route::post('/invent/logout', [SessionController::class, 'logout'])->name('invent.logout');
Route::post('/invent/update-password', [ProfileController::class, 'updatePassword'])->name('invent.updatePassword');






});
