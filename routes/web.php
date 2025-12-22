<?php

use App\Models\Facilitator;
use App\Models\Participants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\EXTController;
use App\Http\Controllers\HRPUController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AIChartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\passwordController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\FacilitatorController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\EventevaluationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('HRPU.web');
});


Route::get('/AdminLogin', function () {
    return view('admin.login');
});
// routes/web.php
Route::get('Info', [HRPUController::class, 'info'])
     ->name('HRPU.web');
Route::get('Login', [HRController::class, 'HRlogin'])
     ->name('HR.Login');
//tes
Route::post('hr/resend-otp', [HRController::class, 'resendOtp'])->name('HR.resendOtp');
Route::get('hr/auto-verify', [HRController::class, 'autoVerify'])->name('HR.autoVerify');
Route::get('/password-request', [PasswordController::class, 'recover'])
     ->name('HR.password');
Route::post('/password-recovery', [PasswordController::class, 'recoverPassword'])
     ->name('password.recovery');
Route::get('Signup', [HRPUController::class, 'singnup'])
     ->name('HRPU.Register');
Route::get('HRPULogin', [HRPUController::class, 'HRPUlogin'])
     ->name('HRPU.Login');
Route::post('/user', [HRPUController::class, 'registerHrpu'])->name('HRPU.User');

     Route::get('/Password', [PasswordController::class, 'hrpupassword'])->name('HRPU.Password');
 Route::post('/Password', [PasswordController::class, 'hrpuTempPassword'])->name('HRPU.reset');
 Route::get('/aps/set-password/{token}', [PasswordController::class, 'showSetPasswordForm'])->name('HRPU.Set');
Route::post('/aps/set-password', [PasswordController::class, 'setNewPassword'])->name('Aps.set.password');

// shoild be removed after  test
Route::get('/view-latest', [ReportController::class,'viewLatestPdf'])->name('view.pdf');
 Route::get('/HR/set-password/{token}', [HRPUController::class, 'showSetPasswordForm'])->name('HRPU.Set');
Route::post('/HR/set-password', [HRPUController::class, 'setNewPassword'])->name('HRPU.set.password');
//ext
Route::get('/External_signup', [EXTController::class, 'EXTsingnup'])
     ->name('EXT.Register');
     Route::post('/Application_user', [EXTController::class, 'registerEXT'])->name('EXT.User');
     Route::get('EXTLogin', [EXTController::class, 'EXTlogin'])
     ->name('EXT.Login');
     Route::get('/EXT/set-password/{token}', [EXTController::class, 'EXTshowSetPasswordForm'])->name('EXT.Set');
Route::post('/EXT/set-password', [EXTController::class, 'EXTsetNewPassword'])->name('EXT.set.password');

Route::get('/Password_online', [EXTController::class, 'extpassword'])->name('EXT.Password');
 Route::post('/Password_online', [EXTController::class, 'extTempPassword'])->name('EXT.reset');
 


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('/password_admin', [TempController::class, 'adminpassword'])->name('admin.forgot.password');
Route::get('/admin/set-password/{token}', [TempController::class, 'showSetPasswordFormadmin'])
    ->name('admin.password.set');

// Handle saving the new password
Route::post('/admin/set-password', [TempController::class, 'setNewPasswordadmin'])
    ->name('admin.password.update');
    Route::post('/admin/reset-password', [TempController::class, 'sendTemporaryPasswordadmin'])
    ->name('admin.password.email');
    //the  ai  inetrephase
  

Route::get('/ai', [AIController::class, 'index'])->name('ai.chart');         // Blade interface
Route::post('/ai/generate', [AIController::class, 'generate'])->name('ai.generate'); // AJAX call
Route::get('/ai/history', [AIController::class, 'history'])->name('ai.history');     // JSON history
//admin  security 
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




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




