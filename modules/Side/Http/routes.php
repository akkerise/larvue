<?php

Route::group(['middleware' => 'web', 'prefix' => 'side', 'namespace' => 'Modules\Side\Http\Controllers'], function()
{
    Route::get('/', 'SideController@index');
});
