<?php

Route::group(['middleware' => ['web'], 'prefix' => 'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function () {
    Route::get('/', 'CmsController@index');
    Route::get('/login', 'Auth\LoginController@index')->name('cms.g.login');
    Route::post('/login', 'Auth\LoginController@login')->name('cms.p.login');
	Route::get('/auth/google', 'Auth\LoginController@redirectToGoogle')->name('cms.auth.google');
    Route::get('/auth/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('cms.handle.google');
});

Route::group(['middleware' => ['web', 'cms'], 'prefix' => 'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function () {
    Route::get('/logout', 'Auth\LogoutController@logout')->name('cms.g.logout');
    Route::get('/dash', 'Dash\DashboardController@index')->name('cms.dash');
});
