<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\GenreRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Repositories\BookRepository;


class BooksController extends Controller
{

    /**
     * @var BookRepository
     */
    protected $repository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var GenreRepository
     */
    protected $genreRepository;


    public function __construct(BookRepository $repository, AuthorRepository $authorRepository, GenreRepository $genreRepository)
    {
        $this->repository = $repository;
        $this->authorRepository = $authorRepository;
        $this->genreRepository = $genreRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $books = $this->repository->with('authors')->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $books,
            ]);
        }

        return view('admin.books.index', ['books'  => $books, 'user' => \Auth::user()]);
    }

    public function create()
    {
        $authors =  $this->authorRepository->all();
        $genres = $this->genreRepository->all();

        return view('admin.books.edit',  [
            'user' => \Auth::user(),
            'genres' => $genres,
            'authors' => $authors

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {

        try {

            $cover = $request->file('image');
            $coverName = $cover->getFilename() . '.' . $cover->getClientOriginalExtension();

            \Storage::disk('covers')->put(
                $coverName,
                file_get_contents($cover->getRealPath())
            );

            $bookFile = $request->file('file');
            $bookName = $bookFile->getClientOriginalName() . '.' . $bookFile->getClientOriginalExtension();
            \Storage::disk('books')->put(
                $bookName,
                file_get_contents($bookFile->getRealPath())
            );

            $data = $request->except(['image', 'file', '_token','authors','genres']);
            $data['image'] = $coverName;
            $data['file'] = $bookName;

            $book = $this->repository->create($data);

            foreach ($request->get('genres') as $genreId){
                $genre = $this->genreRepository->find($genreId);
                $book->genres()->attach($genre);
            }

            foreach ($request->get('authors') as $authorId){
                $author = $this->authorRepository->find($authorId);
                $book->authors()->attach($author);
            }

            $response = [
                'message' => 'Book created.',
                'data'    => $book->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('admin.books.index')->with('message', $response['message']);
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
        $book = $this->repository->with('comments')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $book,
            ]);
        }

        return view('admin.books.show', ['book'=> $book, 'user' => \Auth::user()]);
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

        $book = $this->repository->with(['authors','genres'])->find($id);
        $authors =  $this->authorRepository->all();
        $genres = $this->genreRepository->all();

        return view('admin.books.edit', [
            'genres' => $genres,
            'authors' => $authors,
            'book' => $book,
            'user' => \Auth::user()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BookUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BookUpdateRequest $request, $id)
    {

        try {
            $data = $request->except(['_token', '_method', 'image','file']);

            $book = $this->repository->find($id);

            if ($request->hasFile('image')) {
                $cover = $request->file('image');
                $coverName = $cover->getFilename() . '.' . $cover->getClientOriginalExtension();

                \Storage::disk('covers')->put(
                    $coverName,
                    file_get_contents($cover->getRealPath())
                );

                \Storage::disk('covers')->delete($book->image);

                $data['image'] = $coverName;

            }
            if ($request->hasFile('file')){
                $bookFile = $request->file('file');
                $bookName = $bookFile->getClientOriginalName() . '.' . $bookFile->getClientOriginalExtension();
                \Storage::disk('books')->put(
                        $bookName,
                        file_get_contents($bookFile->getRealPath())
                    );

                \Storage::disk('books')->delete($book->file);

                $data['file'] = $bookName;
            }

            $book = $this->repository->update($data, $id);

            $response = [
                'message' => 'Book updated.',
                'data'    => $book->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->route('admin.books.index')->with('message', $response['message']);
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
        $book = $this->repository->find($id);

        \Storage::disk('covers')->delete($book->image);
        \Storage::disk('books')->delete($book->file);

        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Book deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Book deleted.');
    }
}
