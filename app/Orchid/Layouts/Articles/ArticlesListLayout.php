<?php

namespace App\Orchid\Layouts\Articles;

use App\Models\Article;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ArticlesListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'articles';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('title', __('Article.Label.Title'))->render(function (Article $article) {
                return Link::make($article->title)->route('platform.article.edit', $article->id);
            }),

            TD::make('preview', __('Article.Label.Preview')),

            TD::make('active', __('Article.Label.Active'))->render(function (Article $article) {
                return CheckBox::make()->value($article->active);
            }),

            TD::make('link', __('Article.Label.Link'))->render(function (Article $article) {
                if ($article->link) {
                    return Link::make($article->title)->href($article->link);
                }

                return null;
            }),

            TD::make('created_by', __('Article.Label.Author'))->render(function (Article $article) {
                return $article->author->name;
            }),

            TD::make('created_at', __('Article.Label.CreatedAt')),

            TD::make('updated_at', __('Article.Label.UpdatedAt'))
        ];
    }
}
