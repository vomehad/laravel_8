<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function welcome()
    {
        $users = User::all();

        return view('welcome', ['users' => $users]);
    }

    public function home()
    {
        return view('home');
    }
}
