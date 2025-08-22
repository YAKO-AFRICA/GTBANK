<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OTPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PrestationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/fetch-contract-details', [PrestationController::class, 'fetchContractDetails']);

Route::post('/getPrestations', [PrestationController::class, 'getPrestations'])->name('getPrestations');
Route::post('/send-otpByOrangeAPI', [OTPController::class, 'sendOtpByOrangeAPI']);
Route::post('/send-otpByInfobipAPI', [OTPController::class, 'sendOtpByInfobipAPI']);
Route::post('/verify-otp', [OTPController::class, 'verifyOtp']);



