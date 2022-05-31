<?php

namespace App\Orchid\Screens\Articles;

use App\Orchid\Layouts\Articles\ArticlesListLayout;
use App\Repositories\ArticleRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ArticlesListScreen extends Screen
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'articles' => $this->repository->getAll(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Articles';
    }

    public function description(): ?string
    {
        return "All blog posts";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Article.Button.Create'))->icon('pencil')->route('platform.article.create'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ArticlesListLayout::class
        ];
    }
}
