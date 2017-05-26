<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\GenreRepository;
use App\Validators\GenreValidator;


class GenresController extends Controller
{

    /**
     * @var GenreRepository
     */
    protected $repository;

    /**
     * @var GenreValidator
     */
    protected $validator;

    public function __construct(GenreRepository $repository, GenreValidator $validator)
    {
        $this->repository = $repository;
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
        $genre = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $genre,
            ]);
        }

        return view('genres.show', compact('genre'));
    }

}
