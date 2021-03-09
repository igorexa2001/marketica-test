<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index.master', [
        'navPage' => 'index',
    ]);
})->name('index');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors_index');


Route::group(['prefix' => '/admin'], function () {
    Route::get('/', function () {
        return redirect(\route('admin_books_index'));
    })->name('admin_index');

    Route::group(['prefix' => '/books'], function () {
        Route::get('/', [BookController::class, 'adminIndex'])->name('admin_books_index');
        Route::get('/show', [BookController::class, 'adminShow'])->name('admin_books_show');
        Route::get('/delete', [BookController::class, 'adminShow'])->name('admin_books_delete_confirmation');
        Route::post('/', [BookController::class, 'adminIndex'])->name('admin_books_create');

        Route::post('/', function () {
            return view('welcome');
        })->name('admin_books_update');

        Route::delete('/', function () {
            return view('welcome');
        })->name('admin_books_delete');
    });

    Route::group(['prefix' => '/authors'], function () {
        Route::get('/', [AuthorController::class, 'adminIndex'])->name('admin_authors_index');
        Route::get('/show', [AuthorController::class, 'adminShow'])->name('admin_authors_show');
        Route::get('/delete', [AuthorController::class, 'deleteConfirmation'])->name('admin_authors_delete_confirmation');
        Route::get('/create', [AuthorController::class, 'create'])->name('admin_authors_create');

        Route::post('/show', [AuthorController::class, 'update'])->name('admin_authors_update');
        Route::post('/', [AuthorController::class, 'store'])->name('admin_authors_store');

        Route::delete('/', [AuthorController::class, 'delete'])->name('admin_authors_delete');
    });
});
