<?php

namespace App\Orchid\Screens\Article;

use App\Orchid\Layouts\Article\ArticleListLayout;
use App\Repositories\ArticleRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class ArticleListScreen extends Screen
{
    private const PER_PAGE = 10;

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
        $options = [
            'perPage' => self::PER_PAGE,
            'defaultSort' => 'updated_at'
        ];

        return [
            'articles' => $this->repository->getAll($options),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Article.Orchid.Title');
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
            ArticleListLayout::class
        ];
    }
}
