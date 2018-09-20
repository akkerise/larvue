<?php

Route::any('api/v1/login', 'Modules\Api\Http\Controllers\Auth\LoginController@login');
Route::any('api/v1/facebook', 'Modules\Api\Http\Controllers\Auth\LoginController@facebook');
Route::any('api/v1/google', 'Modules\Api\Http\Controllers\Auth\LoginController@google');
Route::any('api/v1/register', 'Modules\Api\Http\Controllers\Auth\RegisterController@register');
//Route::any('api/v1/info', 'Modules\Api\Http\Controllers\Auth\LoginController@info');

Route::group(['middleware' => ['web'], 'prefix' => 'api/v1', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    // Route::get('/', 'ApiController@index');
    Route::any('/logout', 'Auth\LogoutController@logout');
    Route::any('/info', 'User\UserController@info');
    Route::any('/app', 'App\AppController@app');
});
