<?php

namespace App\Http\Controllers\Api;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $bookRepository;
    private $authorRepository;

    public function __construct(
        BookRepository $bookRepository,
        AuthorRepository $authorRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    /**
     * Get list of all books with author's names
     *
     * @return Application|ResponseFactory|Response
     */
    public function list()
    {
        $books = $this->bookRepository->getAll();

        $output = [];
        foreach ($books as $book){
            $output[] = [
                'id' => $book->id,
                'name' => $book->name,
                'authors' => $book->authors->pluck('name'),
            ];
        }

        return response($output);
    }

    /**
     * Get book by id
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function byId(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 400);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $book->authors; //Для присоединения данных по авторам

        return response($book);
    }

    /**
     * Update book by id
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'book_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 400);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $book = $this->bookRepository->update($book, $request->all());

        return response($book);
    }

    /**
     * Delete book by id
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 400);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $this->bookRepository->delete($book);

        return response([
            'status' => 'OK',
        ]);
    }
}
