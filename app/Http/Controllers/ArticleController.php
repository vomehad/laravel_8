<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class ArticleController extends Controller
{
    public function __construct()
    {
        parent::__construct();
//        $this->nav = [
//            ['url' => route('Test.Main'), 'name' => Lang::get('Test.Menu.Top')],
//            ['url' => route('Test.Note.All'), 'name' => Lang::get('Note.Menu.Top')],
//            ['url' => route('Article.Main'), 'name' => Lang::get('Article.Menu.Top')],
//            ['url' => route('Game'), 'name' => Lang::get('Game.Menu.Top')],
//        ];
    }

    public function index()
    {
        $title = Lang::get(Helper::getActionName());
        $articles = $this->getArticleList();

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
        $article->link = $request->get('link');
        $article->created_by = User::first()->id;
        $article->disk = '';

        $article->save();

        return redirect()->route('Article.View', [
            'id' => $article->id,
        ]);
    }

    public function view(int $id): string
    {
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

    public function search(Request $request)
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $title = Lang::get(Helper::getActionName());
        $articles = $this->getArticleList($string);

        return view('article-index', [
            'title' => $title,
            'models' => $articles,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getArticleList(string $search = '')
    {
        $model = new Article();
        $perPage = 8;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
