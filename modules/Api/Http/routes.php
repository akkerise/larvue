<?php

Route::post('api/v1/login', 'Modules\Api\Http\Controllers\Auth\LoginController@login');

Route::group(['middleware' => 'api-authenticate', 'prefix' => 'api/v1', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{
    // Route::get('/', 'ApiController@index');
    Route::any('/logout', 'Auth\LogoutController@logout');
});
