<?php

namespace App\Orchid\Layouts\Category;

use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Category.Label.Name'))->render(function (Category $category) {
                return Link::make($category->name)->route('platform.category.edit', $category->id);
            })->sort(),

            TD::make('active', __('Category.Label.Active'))->render(function (Category $category) {
                return Switcher::make()
                    ->sendTrueOrFalse()
                    ->value($category->active)
                    ->disabled(true)
                    ;
            })->sort(),

            TD::make('article', __('Category.Label.Article'))->render(function(Category $category) {
                return $category->article()->count();
            })->sort(),

            TD::make('note', __('Category.Label.Note'))->render(function(Category $category) {
                return $category->note()->count();
            })->sort(),

            TD::make('updated_at', __('Category.Label.Updated'))->sort(),
            TD::make('created_at', __('Category.Label.Created'))->sort(),

        ];
    }
}
