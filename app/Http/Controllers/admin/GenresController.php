<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GenreCreateRequest;
use App\Http\Requests\GenreUpdateRequest;
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
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $genres = $this->repository->with('books')->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $genres,
            ]);
        }

        return view('admin.genres.index', ['genres' => $genres, 'user' => \Auth::user()]);
    }

    public function create()
    {
        return view('admin.genres.edit', ['user' => \Auth::user()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  GenreCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GenreCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $genre = $this->repository->create($request->all());

            $response = [
                'message' => 'Genre created.',
                'data'    => $genre->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('genres.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $genre = $this->repository->with('books')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $genre,
            ]);
        }

        return view('admin.genres.show', ['genre' => $genre, 'user' => \Auth::user()]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $genre = $this->repository->find($id);

        return view('admin.genres.edit', ['genre' => $genre, 'user' => \Auth::user()]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GenreUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GenreUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $genre = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Genre updated.',
                'data'    => $genre->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('genres.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Genre deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('genres.index')->with('message', 'Genre deleted.');
    }
}
