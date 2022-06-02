<?php

namespace App\Orchid\Layouts\Kinsman;

use App\Models\Kinsman;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KinsmanLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'kinsmans';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Kinsman.Label.Name'))
                ->render(function(Kinsman $kinsman) {
                    return Link::make($kinsman->name)->route('platform.kinsman.edit', $kinsman->id);
                })->sort(),

            TD::make('middle_name', __('Kinsman.Label.MiddleName'))->sort(),

            TD::make('gender', __('Kinsman.Label.Gender')),

            TD::make('active', __('Kinsman.Label.Active'))->render(function(Kinsman $kinsman) {
                return Switcher::make()->sendTrueOrFalse()->value($kinsman->active)->disabled(true);
            }),

            TD::make('father_id', __('Kinsman.Label.Father'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $father */
                    $father = $kinsman->father ?? null;

                    if ($father) {
                        return Link::make($father->name ." ". $father->middle_name)
                            ->route('platform.kinsman.edit', ['kinsman' => $father->id]);
                    }

                    return null;
                }),

            TD::make('mother_id', __('Kinsman.Label.Mother'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $mother */
                    $mother = $kinsman->mother ?? null;

                    if ($mother) {
                        return Link::make($mother->name ." ". $mother->middle_name)
                            ->route('platform.kinsman.edit', ['kinsman' => $mother->id]);
                    }

                    return null;
                }),

            TD::make('kin_id', __('Kinsman.Label.Kin'))
                ->render(function(Kinsman $kinsman) {
                    $kin = $kinsman->kin ?? null;

                    if ($kin) {
                        return Link::make($kin->name)->route('platform.kin.edit', $kin->id);
                    }

                    return null;
                }),

            TD::make('updated_at', __('Kinsman.Label.Updated'))->sort(),
            TD::make('created_at', __('Kinsman.Label.Created'))->sort(),
        ];
    }
}
