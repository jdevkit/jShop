<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;
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
        $authors = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $authors,
            ]);
        }

        return view('admin.authors.index', [compact('authors'), 'user' => \Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AuthorCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $author = $this->repository->create($request->all());

            $response = [
                'message' => 'Author created.',
                'data'    => $author->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
        $author = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $author,
            ]);
        }

        return view('admin.authors.show', [compact('author'), 'user' => \Auth::user()]);
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

        $author = $this->repository->find($id);

        return view('admin.authors.edit', [compact('author'), 'user' => \Auth::user()]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AuthorUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(AuthorUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $author = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Author updated.',
                'data'    => $author->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
                'message' => 'Author deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Author deleted.');
    }
}
