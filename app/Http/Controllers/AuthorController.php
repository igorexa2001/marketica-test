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

class AuthorController extends Controller
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
     * Show index page
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('authors.master', [
            'navPage' => 'authors',
            'authors' => $this->authorRepository->getAll()
        ]);
    }

    /**
     * Show admin index page
     *
     * @return Application|Factory|View
     */
    public function adminIndex()
    {
        return view('admin.authors.index.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Авторы' => route('admin_authors_index'),
            ],
            'authors' => $this->authorRepository->getAll()
        ]);
    }

    /**
     * Show author update page
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function adminShow(Request $request)
    {
        $author = $this->authorRepository->getById($request->get('author_id'));

        return view('admin.authors.show.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Авторы' => route('admin_authors_index'),
                $author->name => route('admin_authors_show', ['author_id' => $author->id])
            ],
            'otherBooks' => $this->bookRepository->getOthers($author),
            'author' => $author,
        ]);
    }

    /**
     * Find author by id and update with request data
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
            'author_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $author = $this->authorRepository->getById($request->get('author_id'));

        $this->authorRepository->update($author, $request->all());

        return redirect()->route('admin_authors_show', ['author_id' => $author->id])->with(
            'message', [
                'type' => 'success',
                'text' => ['Обновление прошло успешно']
            ]
        );
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function attachBook(Request $request)
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

        return redirect()->route('admin_authors_show', ['author_id' => $author->id])->with('message', [
                'type' => 'success',
                'text' => ['Книга успешно добавлена']
            ]
        );
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function detachBook(Request $request)
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

        $author = $this->authorRepository->getById($request->get('author_id'));
        $book = $this->bookRepository->getById($request->get('book_id'));

        $this->bookRepository->detachAuthor($book, $author);

        return redirect()->route('admin_authors_show', ['author_id' => $author->id])->with('message', [
                'type' => 'success',
                'text' => ['Книга успешно удалена']
            ]
        );
    }

    /**
     * Show author create page
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.authors.create.master', [
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Авторы' => route('admin_authors_index'),
                'Создание' => 'Создание'
            ],
            'navPage' => 'admin',
        ]);
    }

    /**
     * Save new author
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $this->authorRepository->create($request->all());

        return redirect()->route('admin_authors_index')->with(
            'message', [
            'type' => 'success',
            'text' => ['Создание прошло успешно']
        ]);
    }

    /**
     * Show author delete confirmation
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function deleteConfirmation(Request $request)
    {
        $author = $this->authorRepository->getById($request->get('author_id'));

        return view('admin.authors.delete.master', [
            'navPage' => 'admin',
            'breadcrumbs' => [
                'Админ-панель' => route('admin_index'),
                'Авторы' => route('admin_authors_index'),
                $author->name => route('admin_authors_show', ['author_id' => $author->id]),
                'Удаление' => 'Удаление'
            ],
            'author' => $author,
        ]);
    }

    /**
     * Delete author by id
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'author_id' => 'required|exists:authors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'text' => $validator->errors()->all()
            ]);
        }

        $author = $this->authorRepository->getById($request->get('author_id'));

        $this->authorRepository->delete($author);

        return redirect(route('admin_authors_index'))->with(
            'message', [
                'type' => 'success',
                'text' => ['Удаление прошло успешно']
            ]
        );
    }
}
