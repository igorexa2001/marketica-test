<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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

    public function adminIndex()
    {
        return view('admin.books.index.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Книги' => route('admin_books_index'),
            ],
            'books' => $this->bookRepository->getAll(),
        ]);
    }

    /**
     * Show book update page
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function adminShow(Request $request)
    {
        $book = $this->bookRepository->getById($request->get('book_id'));
        return view('admin.books.show.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Книги' => route('admin_books_index'),
                $book->name => route('admin_books_show', ['book_id', $book->id])
            ],
            'otherAuthors' => $this->authorRepository->getOthers($book),
            'book' => $book,
        ]);
    }

    /**
     * Find book by id and update with request data
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books',
            'book_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));

        $this->bookRepository->update($book, $request->all());

        return redirect()->route('admin_books_show', ['book_id' => $book->id])->with('message', [
                'type' => 'success',
                'text' => ['Обновление прошло успешно']
            ]
        );
    }

    /**
     * Attach book to author
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function attachAuthor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $author = $this->authorRepository->getById($request->get('author_id'));

        $this->bookRepository->attachAuthor($book, $author);

        return redirect()->route('admin_books_show', ['book_id' => $book->id])->with('message', [
                'type' => 'success',
                'text' => ['Автор успешно добавлен']
            ]
        );
    }

    /**
     * Detach book from author
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function detachAuthor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $author = $this->authorRepository->getById($request->get('author_id'));

        $this->bookRepository->detachAuthor($book, $author);

        return redirect()->route('admin_books_show', ['book_id' => $book->id])->with('message', [
                'type' => 'success',
                'text' => ['Автор успешно удален']
            ]
        );
    }

    /**
     * Show book create page
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.books.create.master', [
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Книги' => route('admin_books_index'),
                'Создание' => 'Создание',
            ],
            'navPage' => 'admin',
        ]);
    }

    /**
     * Save new book
     *
     * @param Request $request
     * @return RedirectResponse|mixed
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $this->bookRepository->create($request->all());

        return redirect()->route('admin_books_index')->with(
            'message', [
            'type' => 'success',
            'text' => ['Создание прошло успешно']
        ]);
    }

    /**
     * Show book delete confirmation page
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function deleteConfirmation(Request $request)
    {
        $book = $this->bookRepository->getById($request->get('book_id'));

        return view('admin.books.delete.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Книги' => route('admin_books_index'),
                $book->name => route('admin_books_show', ['book_id', $book->id]),
                'Удаление' => 'Удаление'
            ],
            'book' => $book,
        ]);
    }

    /**
     * Delete book by id
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $book = $this->bookRepository->getById($request->get('book_id'));
        $this->bookRepository->delete($book);

        return redirect()->route('admin_books_index')->with('message', [
                'type' => 'success',
                'text' => ['Удаление прошло успешно']
            ]
        );
    }

}
