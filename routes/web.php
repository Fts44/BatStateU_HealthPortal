<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailerController as MailerController;
use App\Http\Controllers\OTPController as OTPController;

use App\Http\Controllers\Index\LoginController as Login;
use App\Http\Controllers\Index\RegistrationController as Registration;
use App\Http\Controllers\Index\RecoverController as Recover;


Route::post('SendOTP',[OTPController::class, 'compose_mail'])->name('SendOTP');
Route::get('logout',[Login::class, 'logout'])->name('Logout');

Route::middleware('IsLoggedIn')->group(function(){
    
    Route::prefix('')->group(function(){
        Route::get('',[Login::class, 'index'])->name('Login');
        Route::post('',[Login::class, 'login'])->name('Login');
        
    });

    Route::prefix('registration')->group(function(){
        Route::get('',[Registration::class, 'index'])->name('Registration');
        Route::post('',[Registration::class, 'register'])->name('Registration');
    });

    Route::prefix('recover')->group(function(){
        Route::get('',[Recover::class, 'index'])->name('Recover');
        Route::post('',[Recover::class, 'recover'])->name('Recover');
    });

});