<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookRepository
{
    /**
     * Get all books
     *
     * @return Book[]|Collection
     */
    public function getAll()
    {
        return Book::all();
    }

    /**
     * Get books that doesn't attached to author
     *
     * @param Author $author
     * @return mixed
     */
    public function getOthers(Author $author)
    {
        return Book::whereNotIn('id', $author->books->pluck('id'))->get();
    }

    /**
     * Create new book
     *
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return Book::create([
            'name' => $request['book_name'],
        ]);
    }

    /**
     * Get book by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Book::where('id', $id)->first();
    }

    /**
     * Update book
     *
     * @param Book $book
     * @param $request
     * @return mixed
     */
    public function update(Book $book, $request)
    {
        $book->name = $request['book_name'];
        $book->save();

        return $book;
    }

    /**
     * Delete book
     *
     * @param Book $book
     * @return bool
     * @throws \Exception
     */
    public function delete(Book $book)
    {
        return $book->delete();
    }

    /**
     * Attach book to author
     *
     * @param Book $book
     * @param Author $author
     */
    public function attachAuthor(Book $book, Author $author)
    {
        $book->authors()->attach($author);
    }

    /**
     * Detach book from author
     *
     * @param Book $book
     * @param Author $author
     */
    public function detachAuthor(Book $book, Author $author)
    {
        $book->authors()->detach($author);
    }
}
