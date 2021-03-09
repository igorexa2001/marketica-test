<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function ()
{
    Route::group(['prefix' => 'v1'], function ()
    {
        Route::group(['prefix' => 'books'], function ()
        {
            Route::get('list', function () {
                return response('Not implemented', 501);
            });
            Route::get('by-id', function () {
                return response('Not implemented', 501);
            });
            Route::post('update', function () {
                return response('Not implemented', 501);
            });
            Route::delete('id', function () {
                return response('Not implemented', 501);
            });
        });
    });
});
