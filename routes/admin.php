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
            Route::prefix('sections')->group(function () {
                Route::resource('sections', 'SectionController');
            });
            Route::prefix('groups')->group(function () {
                Route::resource('groups', 'GroupController');
            });
            Route::prefix('questions')->group(function () {
                Route::resource('questions', 'QuestionController');
            });
            Route::prefix('description')->group(function () {
                Route::resource('description', 'DescriptionController');
            });
            Route::prefix('audio')->group(function () {
                Route::resource('audio', 'AudioController');
            });
            Route::prefix('test')->group(function () {
                Route::get('test', 'TestController@index')->name('test.index');
            });
            Route::prefix('settings')->group(function () {
                Route::resource('settings', 'SettingController');
            });

            Route::get('testData', 'TestController@generate')->name('test.generate');


        });


        Route::get('home', 'HomeController@index')->name('home');
    });
});