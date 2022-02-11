<?php

namespace App\Http\Controllers;

class GameController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.main'), 'name' => 'Testing page'],
            ['url' => route('Game'), 'name' => trans("welcome")],
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
