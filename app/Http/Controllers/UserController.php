<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::all();

        return view('welcome', ['users' => $users]);
    }
}
