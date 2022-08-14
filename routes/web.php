<?php

use Illuminate\Support\Facades\Route;
use App\Permissions\Permission;
use App\Http\Controllers\Admin\UserController;
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

            Route::get('user/list', [UserController::class, 'getUsers'])->name('user.list');
            Route::resource('user', UserController::class)->only([
                'index', 'show'
            ]);
    });

});
