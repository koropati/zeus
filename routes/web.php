<?php

use Illuminate\Support\Facades\Route;
use App\Permissions\Permission;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\DeviceLogController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{ 
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('register', 'Auth\RegisterController@register');
    Route::post('register', 'Auth\RegisterController@store')->name('register');
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::post('login', 'Auth\LoginController@authenticate');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    
    Route::get('forget-password', 'Auth\ForgotPasswordController@getEmail');
    Route::post('forget-password', 'Auth\ForgotPasswordController@postEmail');
    Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getPassword');
    Route::post('reset-password', 'Auth\ResetPasswordController@updatePassword');

    Route::group(['middleware' => ['auth']], function() {
        /**
        * Verification Routes
        */
        Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
        Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
    });

    Route::group(['prefix' => 'app', 'middleware' =>  ['auth','verified']], function () {
            Route::get('/', 'DashboardController@dashboard')->name('dashboard');

            Route::group(['prefix' => 'user'], function () {
                Route::get('/', [UserController::class, 'index'])->name('user.index');
                Route::get('list', [UserController::class, 'getUsers'])->name('user.list');
                Route::get('drop-down', [UserController::class, 'dropDownUser'])->name('user.drop-down');
                Route::post('store', [UserController::class, 'store'])->name('user.store');
                Route::get('edit', [UserController::class, 'edit'])->name('user.edit');
                Route::post('destroy', [UserController::class, 'destroy'])->name('user.destroy');
            });

            Route::group(['prefix' => 'contact'], function () {
                Route::get('/', [ContactController::class, 'index'])->name('contact.index');
                Route::get('list', [ContactController::class, 'getContacts'])->name('contact.list');
                Route::post('store', [ContactController::class, 'store'])->name('contact.store');
                Route::get('edit', [ContactController::class, 'edit'])->name('contact.edit');
                Route::post('destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
            });

            Route::group(['prefix' => 'device'], function () {
                Route::get('/', [DeviceController::class, 'index'])->name('device.index');
                Route::get('list', [DeviceController::class, 'getDevices'])->name('device.list');
                Route::get('drop-down', [DeviceController::class, 'dropDownDevice'])->name('device.drop-down');
                Route::post('store', [DeviceController::class, 'store'])->name('device.store');
                Route::get('edit', [DeviceController::class, 'edit'])->name('device.edit');
                Route::post('destroy', [DeviceController::class, 'destroy'])->name('device.destroy');
            });

            Route::group(['prefix' => 'device-log'], function () {
                Route::get('/', [DeviceLogController::class, 'index'])->name('device-log.index');
                Route::get('list', [DeviceLogController::class, 'getDevices'])->name('device-log.list');
                Route::post('store', [DeviceLogController::class, 'store'])->name('device-log.store');
                Route::get('edit', [DeviceLogController::class, 'edit'])->name('device-log.edit');
                Route::post('destroy', [DeviceLogController::class, 'destroy'])->name('device-log.destroy');
            });
    });

});
