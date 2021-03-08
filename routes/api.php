<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
