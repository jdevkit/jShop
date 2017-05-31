<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CommentCreateRequest;
use App\Repositories\CommentRepository;
use App\Validators\CommentValidator;


class CommentsController extends Controller
{

    /**
     * @var CommentRepository
     */
    protected $repository;

    /**
     * @var CommentValidator
     */
    protected $validator;

    public function __construct(CommentRepository $repository, CommentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CommentCreateRequest $request, $id)
    {

        try {
            $data = $request->all();
            $data['user_id'] = \Auth::id();
            $data['book_id'] = $id;

            $comment = $this->repository->create($data);

            $response = [
                'message' => 'Comment created.',
                'data'    => $comment->toArray(),
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

}
