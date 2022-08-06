<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailerController as MailerController;
use App\Http\Controllers\OTPController as OTPController;
use App\Http\Controllers\PopulateSelectController as PopulateSelect;

use App\Http\Controllers\Index\LoginController as Login;
use App\Http\Controllers\Index\RegistrationController as Registration;
use App\Http\Controllers\Index\RecoverController as Recover;

use App\Http\Controllers\Patient\ProfileController as PatientProfileController;

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

Route::prefix('patient')->group(function(){
   
    Route::prefix('')->group(function(){
        Route::get('',[PatientProfileController::class, 'index'])->name('PatientProfile');
        Route::post('update/{id}',[PatientProfileController::class, 'update_profile'])->name('UpdatePatientProfile');
        Route::post('update/emergencycontact/{id}',[PatientProfileController::class,'update_emergency_contact'])->name('UpdatePatientEmergencyContact');
        Route::post('update/password/{id}',[PatientProfileController::class,'update_password'])->name('UpdatePatientPassword');
    });

    

    Route::prefix('document')->group(function(){
        
    });

    Route::prefix('appoinment')->group(function(){

    });

    Route::prefix('dashboard')->group(function(){

    });

});


Route::prefix('PopulateSelect')->group(function(){

    Route::get('Province',[PopulateSelect::class, 'province'])->name('PopulateProvince');
    Route::get('Municipality/{provCode}',[PopulateSelect::class, 'municipality'])->name('PopulateMunicipality');
    Route::get('Barangay/{citymunCode}',[PopulateSelect::class, 'barangay'])->name('PopulateBarangay');
    Route::get('change',[PopulateSelect::class, 'change']);

});