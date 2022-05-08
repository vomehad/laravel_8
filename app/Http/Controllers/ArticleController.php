<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ArticleRequestStore;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = $this->getArticleList();

        return view('articles.index', [
            'models' => $articles,
            'nav' => $this->nav,
        ]);
    }

    public function create()
    {
        $article = new Article();
        $categories = Category::getAll();
        $tags = Tag::all();

        return view('articles.edit', [
            'model' => $article,
            'categories' => $categories,
            'tag' => $tags,
            'nav' => $this->nav,
        ]);
    }

    public function store(ArticleRequestStore $request): RedirectResponse
    {
        $data = $request->all();

        $article = $request->id ? Article::find($request->id) : new Article();
        $article->fill($data);

        $article->preview = $request->get('title');

        $article->created_by = User::first()->id;
        $article->disk = '';

        $article->save();

        $article->category()->attach(Arr::get($data, 'category'));

        return redirect()->route('articles.show', $article->id);
    }

    public function show(int $id): string
    {
        $article = Article::with(['category'])->where(['id' => $id])->first();

        return view('articles.show', [
            'title' => $article->title,
            'model' => $article,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id)
    {
        $model = Article::find($id);
        $article = Article::with('category')->where(['id' => $id])->first();
        $categories = Category::getAll();

        return view('articles.edit', [
            'title' => $article->title,
            'model' => $article,
            'categories' => $categories,
            'nav' => $this->nav,
        ]);
    }

    public function update()
    {

    }

    public function destroy(int $id): string
    {
        $article = Article::find($id);
        $article->delete();

        return Helper::getActionName();
    }

    public function search(Request $request)
    {
        $string = $request->get('search') ?? $request->query->get('query') ?? '';
        $articles = $this->getArticleList($string);

        return view('articles.index', [
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
