<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', ['user' => \Auth::user()]);
    }

    public function showUsers()
    {
        return view('admin.show.users', ['user' => \Auth::user(),'users' => User::all()]);
    }
}
