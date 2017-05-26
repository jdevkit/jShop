<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RankCreateRequest;
use App\Repositories\RankRepository;
use App\Validators\RankValidator;


class RanksController extends Controller
{

    /**
     * @var RankRepository
     */
    protected $repository;

    /**
     * @var RankValidator
     */
    protected $validator;

    public function __construct(RankRepository $repository, RankValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RankCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RankCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $rank = $this->repository->create($request->all());

            $response = [
                'message' => 'Rank created.',
                'data'    => $rank->toArray(),
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
