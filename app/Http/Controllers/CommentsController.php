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
    public function store(CommentCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $comment = $this->repository->create($request->all());

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
