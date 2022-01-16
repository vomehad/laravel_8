<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    public function welcome()
    {
        $users = User::all();

        return view('welcome', ['users' => $users]);
    }

    public function home()
    {
        $title = Lang::get('basic.home');
        $nav = [
            '/' => $title,
            '/welcome' => trans('basic.welcome'),
        ];

        return view('home', [
            'title' => $title,
            'nav' => $nav,
        ]);
    }
}
