<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Lang;

class ArticleController extends Controller
{
    public function index()
    {
        $title = Lang::get(Helper::getActionName());
        $articles = $this->getArticleList();

        return view('article.index', [
            'title' => $title,
            'models' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getActionName());
        $article = new Article();
        $categories = Category::getAll();
        $tags = Tag::all();

        return view('article.create', [
            'title' => $title,
            'model' => $article,
            'categories' => $categories,
            'tag' => $tags,
            'nav' => $this->nav,
        ]);
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $request->all();
        $article = $request->id ? Article::find($request->id) : new Article();
        $article->fill($data);
//        dump($request->all());
//        $article->category()->sync($request->all()['category']);
//        dd($article);

//        $article->title = $request->get('title');
        $article->preview = $request->get('title');
//        $article->text = $request->get('text');
//        $article->link = $request->get('link');
        $article->created_by = User::first()->id;
        $article->disk = '';
        dd($article);
        $article->category()->sync($request->input('category'));

        $article->save();

        return redirect()->route('Article.View', [
            'id' => $article->id,
        ]);
    }

    public function view(int $id): string
    {
        $article = Article::find($id);

        return view('article.view', [
            'title' => $article->title,
            'model' => $article,
            'nav' => $this->nav,
        ]);
    }

    public function update(int $id)
    {
        $title = Lang::get(Helper::getActionName());
        $model = Article::find($id);
        $categories = Category::getAll();

        return view('article.create', [
            'title' => $title . ' - ' . $model->title,
            'model' => $model,
            'categories' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function delete(int $id): string
    {
        $article = Article::find($id);
        $article->delete();

        return Helper::getActionName();
    }

    public function search(Request $request)
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $title = Lang::get(Helper::getActionName());
        $articles = $this->getArticleList($string);

        return view('article.index', [
            'title' => $title,
            'models' => $articles,
            'nav' => $this->nav,
            'string' => $string,
        ]);
    }

    private function getArticleList(string $search = ''): LengthAwarePaginator
    {
        $model = new Article();
        $perPage = 8;

        if ($search) {
            $model = $model->search($search);
        }

        return $model->paginate($perPage);
    }
}
