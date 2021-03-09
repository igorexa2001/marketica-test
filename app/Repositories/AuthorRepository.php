<?php

namespace App\Repositories;

use App\Models\Author;
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
     * Create new author
     *
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return Author::create([
            'name' => $request['name'],
        ]);
    }

    /**
     * Get author by id
     *
     * @param $request
     * @return mixed
     */
    public function getById($request)
    {
        return Author::where('id', $request['id'])->first();
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
        $author->fill($request);
        $author->save();

        return $author;
    }

    /**
     * Delete author
     *
     * @param $request
     * @return bool
     */
    public function delete($request)
    {
        return Author::where('id', $request['id'])->delete();
    }
}
