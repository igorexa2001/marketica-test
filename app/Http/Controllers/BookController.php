<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    )
    {
        $this->bookRepository = $bookRepository;
    }

    public function adminIndex()
    {
        return view('admin.books.index.master', [
            'navPage' => 'admin',
            'books' => $this->bookRepository->getAll(),
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        return $this->bookRepository->create($request->all());
    }

}
