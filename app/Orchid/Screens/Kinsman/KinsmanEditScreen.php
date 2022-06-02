<?php

namespace App\Orchid\Screens\Kinsman;

use App\Http\Requests\CreateKinsmanRequest;
use App\Http\Requests\UpdateKinsmanRequest;
use App\Models\Kin;
use App\Models\Kinsman;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class KinsmanEditScreen extends Screen
{
    public Kinsman $kinsman;

    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Query data.
     *
     * @param Kinsman $kinsman
     * @return array
     */
    public function query(Kinsman $kinsman): iterable
    {
        return [
            'kinsman' => $kinsman,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->kinsman->exists ? 'Edit person' : 'Creating a new person';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Kinsman.Button.Create'))
                ->icon('note')
                ->method('create')
                ->canSee(!$this->kinsman->exists),

            Button::make(__('Kinsman.Button.Update'))
                ->icon('note')
                ->method('update')
                ->canSee($this->kinsman->exists),

            Button::make(__('Kinsman.Button.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->kinsman->exists),
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

                Input::make('kinsman.id')->type('hidden'),

                Input::make('kinsman.name')
                    ->title(__('Kinsman.Label.Name'))
                    ->placeholder(__('Kinsman.Placeholder.Name')),

                Input::make('kinsman.middle_name')
                    ->title(__('Kinsman.Label.MiddleName'))
                    ->placeholder(__('Kinsman.Placeholder.MiddleName')),

                Select::make('kinsman.gender')
                    ->options([
                        'male' => __('Kinsman.Select.male'),
                        'female' => __('Kinsman.Select.female'),
                    ])
                    ->empty('Not selected')
                    ->title('Kinsman.Label.Gender'),

                Relation::make('kinsman.father')
                    ->fromModel(Kinsman::class, 'name')
                    ->applyScope('fathers')
                    ->displayAppend('fullName')
                    ->title('Kinsman.Label.Father'),

                Relation::make('kinsman.mother')
                    ->fromModel(Kinsman::class, 'name')
                    ->applyScope('mothers')
                    ->displayAppend('fullName')
                    ->title('Kinsman.Label.Mother'),

                Relation::make('kinsman.kin')
                    ->fromModel(Kin::class, 'name')
                    ->title('Kinsman.Label.Kin'),

                CheckBox::make('kinsman.active')
                    ->title(__('Kinsman.Label.Active'))
                    ->sendTrueOrFalse(),
            ]),
        ];
    }

    public function create(CreateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->create($dto);

        Alert::info(__('Kinsman.Message.Created'));

        return redirect()->route('platform.kinsmans');
    }

    public function update(UpdateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $this->repository->update($dto);

        Alert::info(__('Kinsman.Message.Updated'));

        return redirect()->route('platform.kinsmans');
    }

    public function remove(Kinsman $kinsman): RedirectResponse
    {
        $this->repository->remove($kinsman->id);

        Alert::info(__('Kinsman.Message.Deleted'));

        return redirect()->route('platform.kinsmans');
    }
}