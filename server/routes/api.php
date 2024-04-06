<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpareController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\AuthenticationController;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);
Route::get('/clinic/index', [ClinicController::class, 'index']);
Route::get('/spare/index', [SpareController::class, 'index']);
Route::get('/clinic/show/{id}', [ClinicController::class, 'show']);
Route::get('/spare/show/{id}', [SpareController::class, 'show']);

Route::middleware('auth:api')->group(function(){
    Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::post('/reset/{id}', [AuthenticationController::class, 'reset']);
    Route::post('/clinic/store', [ClinicController::class, 'store']);
    Route::post('/spare/store', [SpareController::class, 'store']);
});

//for email verification
Route::get('email/verify/notice', [VerificationController::class, 'notice'])
->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])
->name('verification.resend');


