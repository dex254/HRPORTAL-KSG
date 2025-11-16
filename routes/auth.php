<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
  Route::get('/Admin', [AdminController::class, 'adminlogin'])->name('admin');
    Route::post('/loginsignin', [AdminController::class, 'loginAdmin'])->name('Admin.login');
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

Route::put('/invent/profile/update', [ProfileController::class, 'updateProfile'])->name('invent.profile.update');

Route::get('/invent/innovation/problem', [ReasonsController::class, 'problem'])
    ->name('innovation.problem');

 Route::get('/invent/innovation/step1', [ReasonsController::class, 'step1'])
        ->name('innovation.step1');

    // STEP 2 - Innovation Details
    Route::get('/invent/innovation/step2', [ReasonsController::class, 'step2'])
        ->name('innovation.step2');

    // STEP 3 - Evidence Upload
    Route::get('/invent/innovation/step3', [ReasonsController::class, 'step3'])
        ->name('innovation.step3');

    // STEP 4 - Review / Final Submit
    Route::get('/invent/innovation/step4', [ReasonsController::class, 'step4'])
        ->name('innovation.step4');

    // STEP POST handler for all steps
    Route::post('/invent/innovation/step', [ReasonsController::class, 'storeStep'])
        ->name('innovation.step.store');

    // Final submit (save all)
    Route::post('/invent/innovation/submit', [ReasonsController::class, 'submitAll'])
        ->name('innovation.final.submit');

    // List innovations
    Route::get('/My_Innovations', [ReasonsController::class, 'myInnovations'])
    ->name('innovation.my');
    
// Show edit form
Route::get('/invent/innovation/{id}/edit', [ReasonsController::class, 'edit'])
    ->name('innovation.edit')
    ->middleware('auth:invent');

// Update innovation
Route::put('/invent/innovation/{id}', [ReasonsController::class, 'update'])
    ->name('innovation.update')
    ->middleware('auth:invent');

// Delete innovation
Route::delete('/invent/innovation/{id}', [ReasonsController::class, 'destroy'])
    ->name('innovation.delete')
    ->middleware('auth:invent');


Route::post('/invent/logout', [SessionController::class, 'logout'])->name('invent.logout');
Route::post('/invent/update-password', [ProfileController::class, 'updatePassword'])->name('invent.updatePassword');






});

Route::middleware('Admin.auth')->group(function () {
     Route::get('/Dashboard', [AdminController::class, 'Dashboard'])->name('Admin.Dashboard');
     //logout post
     Route::post('/Admin/logout', [SessionController::class, 'adminlogout'])->name('Admin.logout');
      Route::get('/Admin_data', [DataController::class, 'adminsdata'])->name('admin.all');
    // routes/web.php
Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');
//admin  register
Route::get('/Admin_register', [AdminController::class, 'adminsignup'])->name('AdminRegistration');
    Route::post('/Admin_register', [AdminController::class, 'admincreate'])->name('Admin.Create');
    Route::get('/Ctdrt', [DataController::class, 'datactdrt'])->name('CTDRT');
    Route::get('/Innovations', [DataController::class, 'innovationsdata'])->name('Innovationsdata');
    Route::get('/admin_inventions', [DataController::class, 'innovations'])
    ->name('inventions.list');

Route::get('/admin_/{id}', [DataController::class, 'innovationsDetails'])
    ->name('inventions.details');
//test  dexa
Route::post('/user/{id}/update-email', [UserController::class, 'updateEmail'])->name('update.invent.email');
Route::post('/user/{id}/update-status', [UserController::class, 'updateStatus'])->name('update.invent.status');


    // STEP 4 - Review / Final Submit
  






});
