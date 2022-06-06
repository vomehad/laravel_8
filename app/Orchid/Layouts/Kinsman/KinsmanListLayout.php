<?php

namespace App\Orchid\Layouts\Kinsman;

use App\Models\Kinsman;
use Carbon\Carbon;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class KinsmanListLayout extends Table
{
    protected $target = 'kinsmans';

    protected function columns(): iterable
    {
        return [

            TD::make('name', __('Kinsman.Label.Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function(Kinsman $kinsman) {
//                    return new Persona($user->presenter());
                    return Link::make($kinsman->name)->route('platform.kinsman.edit', $kinsman->id);
                }
            ),

            TD::make('middle_name', __('Kinsman.Label.MiddleName'))
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('gender', __('Kinsman.Label.Gender'))
                ->render(function(Kinsman $kinsman) {
                    return $kinsman->getGender($kinsman->gender);
                }
            ),

            TD::make('active', __('Kinsman.Label.Active'))
                ->sort()
                ->render(function(Kinsman $kinsman) {
                    return Switcher::make()->sendTrueOrFalse()->value($kinsman->active)->disabled(true);
                }
            ),

            TD::make('father_id', __('Kinsman.Label.Father'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $father */
                    $father = $kinsman->father ?? null;

                    if ($father) {
                        return Link::make($father->name ." ". $father->middle_name)
                            ->route('platform.kinsman.edit', ['kinsman' => $father->id]);
                    }

                    return null;
                }
            ),

            TD::make('mother_id', __('Kinsman.Label.Mother'))
                ->render(function(Kinsman $kinsman) {
                    /** @var Kinsman $mother */
                    $mother = $kinsman->mother ?? null;

                    if ($mother) {
                        return Link::make($mother->name ." ". $mother->middle_name)
                            ->route('platform.kinsman.edit', ['kinsman' => $mother->id]);
                    }

                    return null;
                }
            ),

            TD::make('kin_id', __('Kinsman.Label.Kin'))
                ->render(function(Kinsman $kinsman) {
                    $kin = $kinsman->kin ?? null;

                    if ($kin) {
                        return Link::make($kin->name)->route('platform.kin.edit', $kin->id);
                    }

                    return null;
                }
            ),

            TD::make('updated_at', __('Kinsman.Label.Updated'))
                ->sort()
                ->render(function(Kinsman $kinsman) {
                    return Carbon::make($kinsman->updated_at)->format('j-M-Y H:i');
                }),
            TD::make('created_at', __('Kinsman.Label.Created'))->sort(),

            TD::make(__('Kinsman.Button.Action'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function(Kinsman $kinsman) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Kinsman.Button.Update'))
                                ->icon('pencil')
                                ->route('platform.kinsman.edit', $kinsman->id),

                            /*Button::make(__('Kinsman.Button.Delete'))
                                ->icon('trash')
                                ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->method('remove'),*/
                        ]
                    );
                }
            ),
        ];
    }
}
