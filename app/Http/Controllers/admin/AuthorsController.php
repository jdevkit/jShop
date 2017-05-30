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

        return view('admin.authors.index', ['authors' => $authors, 'user' => \Auth::user()]);
    }

    public function create()
    {
        return view('admin.authors.edit', ['user' => \Auth::user()]);
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

            $author = $request->file('image');
            $authorPhoto = $author->getFilename() . '.' . $author->getClientOriginalExtension();
            $author->move(public_path('/img/authors') ,$authorPhoto);

            $data = $request->except(['_token', 'image']);
            $data['image'] = $authorPhoto;

            $author = $this->repository->create($data);

            $response = [
                'message' => 'Author created.',
                'data'    => $author->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('admin.authors.index')->with('message', $response['message']);
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
        $author = $this->repository->with('books')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $author,
            ]);
        }

        return view('admin.authors.show', ['author' => $author, 'user' => \Auth::user()]);
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

        return view('admin.authors.edit', ['author' => $author, 'user' => \Auth::user()]);
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

            $data = $request->except(['_token', '_method', 'image']);

            if ($request->hasFile('image')) {
                $authorPhoto = $request->file('image');
                $authorPhotoName = $authorPhoto->getFilename() . '.' . $authorPhoto->getClientOriginalExtension();

                \Storage::disk('authors')->put(
                    $authorPhotoName,
                    file_get_contents($authorPhoto->getRealPath())
                );

                $author = $this->repository->find($id);
                \Storage::disk('authors')->delete($author->image);

                $data = $request->except(['_token', 'image']);
                $data['image'] = $authorPhotoName;
            }

            $author = $this->repository->update($data, $id);

            $response = [
                'message' => 'Author updated.',
                'data'    => $author->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('authors.index')->with('message', $response['message']);
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
        $author = $this->repository->find($id);

        \Storage::disk('authors')->delete($author->image);

        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Author deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('authors.index')->with('message', 'Author deleted.');
    }
}
