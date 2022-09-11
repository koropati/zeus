<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiDeviceLogController;
use App\Http\Controllers\Api\ApiDeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'log'], function () {
    Route::post('store', [ApiDeviceLogController::class, 'store'])->name('api-device-log.store');
});

Route::group(['prefix' => 'device'], function () {
    Route::post('store', [ApiDeviceController::class, 'store'])->name('api-device.store');
    Route::get('store', [ApiDeviceController::class, 'storeGet'])->name('api-device.storeget');
});