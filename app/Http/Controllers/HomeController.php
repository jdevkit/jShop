<?php

namespace App\Http\Controllers;

use App\Repositories\BookRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    protected $bookRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->middleware('auth');
        $this->bookRepository = $bookRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->bookRepository->with(['comments','genres'])->paginate(8);
        return view('home',['books' => $books]);
    }
}
