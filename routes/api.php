<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SmsController;
use App\Http\Controllers\Api\DeviceDataController;

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

Route::get('unauthorized-user', function(){
    return response()->json(['status' => 401,'message' => 'unauthorized user'], 401);
})->name('unauthorized-user');






Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware('auth:sanctum')->group( function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [ProfileController::class, 'profile']);
});


Route::post('/send-sms', [SmsController::class, 'sendSms']);

Route::post('/handle-device-data', [DeviceDataController::class, 'handleDeviceData']);