<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    private $authorRepository;

    public function __construct(
        AuthorRepository $authorRepository
    )
    {
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
            'authors' => $this->authorRepository->getAll()
        ]);
    }

    /**
     * Show author update form
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function adminShow(Request $request)
    {
        return view('admin.authors.show.master', [
            'navPage' => 'admin',
            'author' => $this->authorRepository->getById($request->all()),
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
        return view('admin.authors.delete.master', [
            'navPage' => 'admin',
            'author' => $this->authorRepository->getById($request->all()),
        ]);
    }

    /**
     * Show author create page
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.authors.create.master', [
            'navPage' => 'admin',
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
        $author = $this->authorRepository->getById($request->all());

        if (!$author) {
            //TODO add error bag
            return redirect()->back()->withErrors([]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            //TODO translate error bag
            return redirect()->back()->withErrors($validator->errors());
        }

        $author = $this->authorRepository->update($author, $request->all());

        //TODO add success message
        return redirect(route('admin_authors_index'))->with([
            'message' => $author,
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
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            //TODO translate error bag
            return redirect()->back()->withErrors($validator->errors());
        }

        $author = $this->authorRepository->create($request->all());

        //TODO add success message
        return redirect(route('admin_authors_index'))->with([
            'message' => $author,
        ]);
    }
}
