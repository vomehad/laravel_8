<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
//            ['url' => route('Home'), 'name' => "Home"],
            ['url' => route('Game'), 'name' => trans("welcome")],
            ['url' => route('Regex'), 'name' => trans("regex")],
        ];
    }
    public function playGame(): string
    {
        return view('playGame', [
            'title' => 'Find All Pairs',
            'nav' => $this->nav,
        ]);
    }

    public function createRecord()
    {

    }
}
