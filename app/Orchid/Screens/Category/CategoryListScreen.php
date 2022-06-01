<?php

namespace App\Orchid\Screens\Category;

use App\Orchid\Layouts\Category\CategoryListLayout;
use App\Repositories\CategoryRepository;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
    private CategoryRepository $repository;

    public function __construct(CategoryRepository $repository)
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
            'categories' => $this->repository->getAll(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('Category.Orchid.Title');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Category.Button.Create'))->icon('pencil')->route('platform.category.create')
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
            CategoryListLayout::class,
        ];
    }
}
