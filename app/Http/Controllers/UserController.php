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
            ['url' => '/', 'name' => Route::getCurrentRoute()->getName()],
            ['url' => '/welcome', 'name' => trans('basic.welcome')]
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
}
