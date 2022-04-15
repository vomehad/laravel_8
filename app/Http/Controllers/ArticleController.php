<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
        $title = Lang::get(Helper::getActionName());
        $articles = Article::paginate (8);

        return view('article-index', [
            'title' => $title,
            'models' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getActionName());
        $article = new Article();

        return view('article-create', [
            'title' => $title,
            'nav' => $this->nav,
            'model' => $article,
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $article = $request->id ? Article::find($request->id) : new Article();

        $article->title = $request->get('title');
        $article->preview = $request->get('title');
        $article->text = $request->get('text');
        $article->created_by = User::first()->id;
        $article->disk = '';

        $article->save();

        return redirect()->route('Article.View', [
            'id' => $article->id,
        ]);
    }

    public function view(int $id): string
    {
//        $title = Lang::get(Helper::getActionName());
        $article = Article::find($id);

        return view('article-view', [
            'title' => $article->title,
            'model' => $article,
            'nav' => $this->nav,
        ]);
    }

    public function update(int $id)
    {
        $title = Lang::get(Helper::getActionName());
        $model = Article::find($id);

        return view('article-create', [
            'title' => $title . ' - ' . $model->title,
            'model' => $model,
            'nav' => $this->nav,
        ]);
    }

    public function delete(int $id): string
    {
        $note = Article::find($id);
        $note->delete();

        return Helper::getActionName();
    }
}
