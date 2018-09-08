<?php

Route::group(['middleware' => 'web', 'prefix' => 'todo', 'namespace' => 'Modules\Todo\Http\Controllers'], function()
{
    Route::get('/', 'TodoController@index');
});
