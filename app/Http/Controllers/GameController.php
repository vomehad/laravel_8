<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Lang;

class GameController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function playGame(): string
    {
        $title = Lang::get(Helper::getActionName() . '.Title');
        $rows = 4;
        $startItem = 1;

        return view('play.game', [
            'title' => $title,
            'nav' => $this->nav,
            'rows' => $rows,
            'item' => $startItem
        ]);
    }

    public function createRecord()
    {

    }
}
