<?php

namespace App\Http\Controllers;

use App\Models\User;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\never;

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

        if ($word) {
            $pattern = '/(.)/';

            $word = preg_replace_callback(
                $pattern,
                function($matches) {
                    return reset($matches) . " ";
                },
                $word
            );
        }

        return view('regex', [
            'title' => $title,
            'nav' => $this->nav,
            'regex' => $word,
        ]);
    }
}
