<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Api')->group(function ()
{
    Route::group(['prefix' => 'v1'], function ()
    {
        Route::group(['prefix' => 'books'], function ()
        {
            Route::get('list', [BookController::class, 'list']);
            Route::get('by-id', [BookController::class, 'byId']);
            Route::post('update', [BookController::class, 'update']);
            Route::delete('id',  [BookController::class, 'delete']);
        });
    });
});
