<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::group(['prefix' => '/admin'], function () {
    Route::get('/', function () {
        return redirect(\route('admin_books_index'));
    });

    Route::group(['prefix' => '/books'], function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('admin_books_index');

        Route::post('/', function () {
            return view('welcome');
        })->name('admin_books_create');

        Route::post('/', function () {
            return view('welcome');
        })->name('admin_books_update');

        Route::delete('/', function () {
            return view('welcome');
        })->name('admin_books_delete');
    });

    Route::group(['prefix' => '/authors'], function () {
        Route::get('/', function () {
            return view('welcome');
        })->name('admin_authors_index');

        Route::post('/', function () {
            return view('welcome');
        })->name('admin_authors_create');

        Route::post('/', function () {
            return view('welcome');
        })->name('admin_authors_update');

        Route::delete('/', function () {
            return view('welcome');
        })->name('admin_authors_delete');
    });
});
