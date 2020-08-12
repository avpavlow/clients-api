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

    Route::post('/', 'ClientController@store')->name('clients.store');
    Route::get('/', 'ClientController@index')->name('clients.index');
    Route::get('/{id}', 'ClientController@show')->name('clients.show');
    Route::match(['put', 'patch'], '/{id}', 'ClientController@update')->name('clients.update');
    Route::delete('/{id}', 'ClientController@delete')->name('clients.delete');
});
