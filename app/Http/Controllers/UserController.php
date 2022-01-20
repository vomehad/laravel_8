<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => '/', 'name' => "Home"],
            ['url' => '/welcome', 'name' => trans('basic.welcome')],
            ['url' => '/useRegex', 'name' => trans('basic.regex')],
        ];
    }

    public function welcome()
    {
//        $users = User::all();

        return view('welcome', [
            'title' => Route::getCurrentRoute()->getName(),
            'nav' => $this->nav,
        ]);
    }

    public function home()
    {
        $title = Lang::get('basic.home');

        return view('home', [
            'title' => $title,
            'nav' => $this->nav,
        ]);
    }

    public function useRegex(?string $word = ""): string
    {
        $title = Lang::get('basic.regex');

        $splitWord = preg_replace('/(.)/', "$1 ", $word);

        return view('regex', [
            'title' => $title,
            'nav' => $this->nav,
            'regex' => $splitWord,
        ]);
    }
}
