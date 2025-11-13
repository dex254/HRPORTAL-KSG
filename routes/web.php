<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CTDRTController;
use App\Http\Controllers\InventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NominationController;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[CTDRTController::class, 'ctdrt'])->name('CTDRT.Form');
Route::get('/ctdrt/subcounties', [CTDRTController::class, 'getSubCounties'])->name('ctdrt.subcounties');
Route::post('/post',[NominationController::class, 'submitstore'])->name('nomination.store');
//the   login
Route::get('/Sign_up', [InventController::class, 'Inventsignup'])->name('invent.signup');
Route::post('/Sign_up/Save', [InventController::class, 'Inventregister'])->name('Invent.register');

Route::get('/password', [InventController::class, 'password'])->name('invent.password');
//auth
Route::get('/invent/otp', [InventController::class, 'showOtp'])->name('invent.otp.page');
Route::get('/invent/otp/resend', [InventController::class, 'resendOtp'])
    ->name('invent.resend.otp');

Route::get('/invent/otp', function (Request $request) {
    $email = $request->query('email'); // fetch ?email=... from URL
    return view('Invent.otp', ['email' => $email]);
})->name('Invent.otp');
// OTP verify link (from email button)
Route::get('/invent/otp/verify', function (Request $request) {
    return view('Invent.verify', ['email' => $request->email]);
})->name('invent.otp.verify.page');
//
Route::get('/invent/otp/quick-verify', [InventController::class, 'quickVerifyOtp'])
    ->name('invent.otp.quick.verify');

// OTP form submission
Route::post('/invent/otp/verify', [InventController::class, 'verifyOtp'])->name('invent.otp.verify');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
