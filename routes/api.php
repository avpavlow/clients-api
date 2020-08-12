<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', 'Api\Auth\RegisterController@register')->name('auth.register');
Route::post('login', 'Api\Auth\LoginController@login')->name('auth.login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::delete('/logout', 'Api\Auth\LoginController@logout')->name('auth.logout');;

    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::post('clients', 'Api\ClientController@store')->name('clients.store');
    Route::get('clients', 'Api\ClientController@index')->name('clients.index');
    Route::get('clients/{id}', 'Api\ClientController@show')->name('clients.show');
    Route::match(['put', 'patch'], 'clients/{id}', 'Api\ClientController@update')->name('clients.update');
    Route::delete('clients/{id}', 'Api\ClientController@delete')->name('clients.delete');
});
