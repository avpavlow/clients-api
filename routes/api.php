<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'Api\Auth\RegisterController@register')->name('auth.register');
Route::post('login', 'Api\Auth\LoginController@login')->name('auth.login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::delete('/logout', 'Api\Auth\LoginController@logout')->name('auth.logout');;

    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});
