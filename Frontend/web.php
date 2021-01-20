<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Frontend\Controllers',
    'middleware' => 'web'
], function () {

    Route::get('/', function () {
        return view('F::layouts.main');
    })->name('home');

    Route::get('login', 'AuthController@loginForm')->name('login.form');
    Route::post('login', 'AuthController@login')->name('login');

    Route::get('register', 'AuthController@registerForm')->name('register.form');
    Route::post('register', 'AuthController@register')->name('register');

    Route::get('verified', 'AuthController@verified')->name('verified');

    Route::get('forgotten-password', 'AuthController@forgottenPasswordForm')->name('forgotten-password.form');
    Route::post('forgotten-password', 'AuthController@forgottenPassword')->name('forgotten-password');

    Route::get('new-password', 'AuthController@newPasswordForm')->name('new-password.form');
    Route::post('new-password', 'AuthController@newPassword')->name('new-password');

    Route::post('check-login-ajax', 'AuthController@checkLoginAjax')->name('check-login-ajax');

    Route::get('logout', 'AuthController@logout')->name('logout');

});

