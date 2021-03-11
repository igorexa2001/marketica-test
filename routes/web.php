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
        Route::post('/show', [BookController::class, 'update'])->name('admin_books_update');

        Route::post('/show/attach-author', [BookController::class, 'attachAuthor'])->name('admin_books_attach_author');
        Route::post('/show/detach-author', [BookController::class, 'detachAuthor'])->name('admin_books_detach_author');

        Route::get('/create', [BookController::class, 'create'])->name('admin_books_create');
        Route::post('/create', [BookController::class, 'store'])->name('admin_books_store');

        Route::get('/delete', [BookController::class, 'deleteConfirmation'])->name('admin_books_delete_confirmation');
        Route::post('/delete', [BookController::class, 'delete'])->name('admin_books_delete');
    });

    Route::group(['prefix' => '/authors'], function () {
        Route::get('/', [AuthorController::class, 'adminIndex'])->name('admin_authors_index');

        Route::get('/show', [AuthorController::class, 'adminShow'])->name('admin_authors_show');
        Route::post('/show', [AuthorController::class, 'update'])->name('admin_authors_update');

        Route::post('/show/attach-book', [AuthorController::class, 'attachBook'])->name('admin_authors_attach_book');
        Route::post('/show/detach-book', [AuthorController::class, 'detachBook'])->name('admin_authors_detach_book');

        Route::get('/create', [AuthorController::class, 'create'])->name('admin_authors_create');
        Route::post('/create', [AuthorController::class, 'store'])->name('admin_authors_store');

        Route::get('/delete', [AuthorController::class, 'deleteConfirmation'])->name('admin_authors_delete_confirmation');
        Route::post('/delete', [AuthorController::class, 'delete'])->name('admin_authors_delete');
    });
});
