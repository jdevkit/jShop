<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\AuthorRepository;
use App\Validators\AuthorValidator;


class AuthorsController extends Controller
{

    /**
     * @var AuthorRepository
     */
    protected $repository;

    /**
     * @var AuthorValidator
     */
    protected $validator;

    public function __construct(AuthorRepository $repository, AuthorValidator $validator)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $authors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $authors,
            ]);
        }

        return view('authors.index', compact('authors'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = $this->repository->with('books')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $author,
            ]);
        }

        return view('authors.show', ['author' => $author]);
    }

}
