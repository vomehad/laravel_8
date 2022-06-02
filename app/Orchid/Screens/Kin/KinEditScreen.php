<?php

namespace App\Orchid\Screens\Kin;

use App\Models\Kin;
use App\Models\User;
use App\Repositories\KinRepository;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class KinEditScreen extends Screen
{
    public Kin $kin;

    private KinRepository $repository;

    public function __construct(KinRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @param Kin $kin
     * @return array
     */
    public function query(Kin $kin): iterable
    {
        return [
            'kin' => $kin,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->kin->exists ? 'Edit kin' : 'Creating a new kin';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Kin.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->kin->exists),

            Button::make(__('Kin.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->kin->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('kin.id')->type('hidden'),

                Input::make('kin.name')
                    ->title(__('Kin.Label.Name'))
                    ->placeholder(__('Kin.Placeholder.Name')),

                Input::make('kin.slug')
                    ->title(__('Kin.Label.Slug'))
                    ->placeholder(__('Kin.Placeholder.Slug')),

                Relation::make('kin.created_by')
                    ->fromModel(User::class, 'name')
                    ->title('Kin.Label.CreatedBy'),

                CheckBox::make('kin.active')
                    ->title(__('Kin.Label.Active'))
                    ->sendTrueOrFalse(),
            ]),
        ];
    }
}
