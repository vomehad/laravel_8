<?php

namespace App\Orchid\Layouts\Kin;

use App\Models\Kin;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KinLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'kins';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Kin.Label.Name'))
                ->render(function(Kin $kin) {
                    return Link::make($kin->name)->route('platform.kin.edit', $kin->id);
                })->sort(),

            TD::make('slug', __('Kin.Label.Slug'))->sort(),

            TD::make('active', __('Kin.Label.Active'))->render(function(Kin $kin) {
                return Switcher::make()->sendTrueOrFalse()->value($kin->active)->disabled(true);
            })->sort(),

            TD::make('updated_at', __('Kin.Label.Updated'))->sort(),
            TD::make('created_at', __('Kin.Label.Created'))->sort(),

        ];
    }
}
