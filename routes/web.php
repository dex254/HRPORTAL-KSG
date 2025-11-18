<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CTDRTController;
use App\Http\Controllers\InventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\NominationController;
use App\Models\Admin;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[CTDRTController::class, 'ctdrt'])->name('CTDRT.Form');
Route::get('/ctdrt/subcounties', [CTDRTController::class, 'getSubCounties'])->name('ctdrt.subcounties');
Route::get('/autocomplete-nominee', [CTDRTController::class, 'autocompleteNominee'])->name('autocomplete.nominee');

Route::post('/post',[NominationController::class, 'submitstore'])->name('nomination.store');
//the   login
Route::get('/Sign_up', [InventController::class, 'Inventsignup'])->name('invent.signup');
Route::post('/Sign_up/Save', [InventController::class, 'Inventregister'])->name('Invent.register');


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


Route::get('/password', [InventController::class, 'password'])->name('invent.password');

// Handle sending the reset link email
Route::post('/invent/reset-password', [PasswordController::class, 'sendTemporaryPassword'])
    ->name('invent.password.email');

// Show form to set a new password (from email link)
Route::get('/invent/set-password/{token}', [PasswordController::class, 'showSetPasswordForm'])
    ->name('invent.password.set');

// Handle setting the new password
Route::post('/invent/set-password', [PasswordController::class, 'setNewPassword'])
    ->name('invent.password.update');
    //admin  data
    
//
Route::get('/password_admin', [AdminController::class, 'adminpassword'])->name('admin.forgot.password');

//verify
Route::get('/Admin_otp', [AdminController::class, 'showOtpadmin'])->name('Admin.otp');
Route::get('/Admin/otp/resend', [AdminController::class, 'resendOtpadmin'])
    ->name('admin.resend.otp');

Route::get('/admin/otp', function (Request $request) {
    $email = $request->query('email'); // fetch ?email=... from URL
    return view('Admin.otp', ['email' => $email]);
})->name('Invent.otp');
// OTP verify link (from email button)
Route::get('/Admin/otp/verify', function (Request $request) {
    return view('Admin.verify', ['email' => $request->email]);
})->name('Admin.otp.verify.page');
//
Route::get('/Admin/otp/quick-verify', [AdminController::class, 'quickVerifyOtpadmin'])
    ->name('Admin.otp.quick.verify');

// OTP form submission
Route::post('/Admin/otp/verify', [AdminController::class, 'verifyOtpadmin'])->name('Admin.otp.verify');
//password 
// Send temporary password to admin email
Route::post('/admin/reset-password', [PasswordController::class, 'sendTemporaryPasswordadmin'])
    ->name('admin.password.email');

// Show form to set a new password
Route::get('/admin/set-password/{token}', [PasswordController::class, 'showSetPasswordFormadmin'])
    ->name('admin.password.set');

// Handle saving the new password
Route::post('/admin/set-password', [PasswordController::class, 'setNewPasswordadmin'])
    ->name('admin.password.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
