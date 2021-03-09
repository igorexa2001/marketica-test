<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getAll()
    {
        return Book::all();
    }

    public function create($request)
    {
        return Book::create([
            'name' => $request['name'],
        ]);
    }

    public function getById($request)
    {
        return Book::where('id', $request['id'])->first();
    }

    public function update($request)
    {
        $book = Book::where('id', $request['id'])->first();

        $book->name = $request['name'];
        $book->save();

        return $book;
    }

    public function delete($request)
    {
        Book::where('id', $request['id'])->delete();

        return true;
    }
}
