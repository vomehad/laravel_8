<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Lang;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.Main'),           'name' => Lang::get('Test.Menu.Top')],
            ['url' => route('Test.Note.All'),       'name' => Lang::get('Note.Menu.Top')],
            ['url' => route('Test.Category.List'),  'name' => Lang::get('Category.Menu.Top')],
            ['url' => route('Tag.List'),            'name' => Lang::get('Tag.Menu.Top')],
            ['url' => route('Article.Main'),        'name' => Lang::get('Article.Menu.Top')],
            ['url' => route('Game'),                'name' => Lang::get('Game.Menu.Top')],
            ['url' => route('User.List'),           'name' => Lang::get('User.Menu.Top')],
        ];
    }
}
