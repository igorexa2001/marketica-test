<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $books = Book::factory(10)->create();
        $authors = Author::factory(10)->create();

        foreach ($books as $book) {
            $book->authors()->attach($authors->random(2));
        }

        foreach ($authors as $author) {
            if (!$author->books()) {
                $author->books()->attach($books->random(1));
            }
        }
    }
}
