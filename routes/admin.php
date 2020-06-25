<?php

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

    Route::namespace('Auth')->middleware('guest:admin')->group(function () {

        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');

        //Forgot Password Routes
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

        //Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');

    });
    Route::namespace('Auth')->middleware('auth:admin')->group(function () {
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::namespace('Test')->group(function () {
            Route::prefix('test')->group(function () {
                Route::resource('sections', 'SectionController');
                Route::resource('groups', 'GroupController');
                Route::resource('questions', 'QuestionController');
                Route::resource('description', 'DescriptionController');
                Route::resource('audio', 'AudioController');
                Route::resource('settings', 'SettingController');
                Route::get('testData', 'TestController@generate')->name('test.generate');
                Route::get('test', 'TestController@index')->name('test.index');
            });
        });
        Route::get('home', 'HomeController@index')->name('home');
    });
});