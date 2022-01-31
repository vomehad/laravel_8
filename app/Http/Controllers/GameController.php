<?php

namespace App\Http\Controllers;

class GameController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Game'), 'name' => trans("welcome")],
            ['url' => route('Regex'), 'name' => trans("regex")],
        ];
    }
    public function playGame(): string
    {
        $rows = 4;
        $startItem = 1;

        return view('playGame', [
            'title' => 'Find All Pairs',
            'nav' => $this->nav,
            'rows' => $rows,
            'item' => $startItem
        ]);
    }

    public function createRecord()
    {

    }
}
