<?php

use Illuminate\Support\Facades\Route;
use App\Permissions\Permission;

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

    Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
        Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    });
});
