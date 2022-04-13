<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Article;
use Illuminate\Support\Facades\Lang;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.Main'), 'name' => Lang::get('Test.Menu.Top')],
            ['url' => route('Test.Note.All'), 'name' => Lang::get('Note.Menu.Top')],
            ['url' => route('Article.Main'), 'name' => Lang::get('Article.Menu.Top')],
            ['url' => route('Game'), 'name' => Lang::get('Game.Menu.Top')],
        ];
    }

    public function index()
    {
        $title = Lang::get(Helper::getAction());
        $articles = Article::all();

        return view('article-index', [
            'title' => $title,
            'articles' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getAction());
        $article = new Article();

        return view('article-create', [
            'title' => $title,
            'nav' => $this->nav,
            'model' => $article,
        ]);
    }
}
