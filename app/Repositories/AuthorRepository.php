<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository
{
    /**
     * Get all authors
     *
     * @return Author[]|Collection
     */
    public function getAll()
    {
        return Author::all();
    }

    /**
     * Get authors that doesn't attached to book
     *
     * @param Book $book
     * @return mixed
     */
    public function getOthers(Book $book)
    {
        return Author::whereNotIn('id', $book->authors->pluck('id'))->get();
    }

    /**
     * Create new author
     *
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return Author::create([
            'name' => $request['author_name'],
        ]);
    }

    /**
     * Get author by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Author::where('id', $id)->first();
    }

    /**
     * Update author
     *
     * @param Author $author
     * @param $request
     * @return mixed
     */
    public function update(Author $author, $request)
    {
        $author->name = $request['author_name'];
        $author->save();

        return $author;
    }

    /**
     * Delete author
     *
     * @param Author $author
     * @return bool
     * @throws \Exception
     */
    public function delete(Author $author)
    {
        return $author->delete();
    }
}
