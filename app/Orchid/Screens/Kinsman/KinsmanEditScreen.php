<?php

namespace App\Orchid\Screens\Kinsman;

use App\Http\Requests\CreateKinsmanRequest;
use App\Http\Requests\UpdateKinsmanRequest;
use App\Models\Kin;
use App\Models\Kinsman;
use App\Repositories\KinsmanRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Map;
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
        return $this->kinsman->exists ? __('Kinsman.Orchid.Update') : __('Kinsman.Orchid.Create');
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [

            Button::make(__('Kinsman.Button.Create'))
                ->icon('plus')
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
     * @throws BindingResolutionException
     */
    public function layout(): iterable
    {
        $geo = $this->kinsman->nativeCity->first()->geo ?? null;
        $coordinates = $geo ? json_decode($geo) : null;

        return [

            Layout::columns([

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
                            'male' => __('Kinsman.Select.Male'),
                            'female' => __('Kinsman.Select.Female'),
                        ])
                        ->empty('Not selected')
                        ->title('Kinsman.Label.Gender'),

                    Relation::make('kinsman.father_id')
                        ->fromModel(Kinsman::class, 'name', 'id')
                        ->applyScope('fathers')
                        ->displayAppend('fullName')
                        ->title('Kinsman.Label.Father'),

                    Relation::make('kinsman.mother_id')
                        ->fromModel(Kinsman::class, 'name', 'id')
                        ->applyScope('mothers')
                        ->displayAppend('fullName')
                        ->title('Kinsman.Label.Mother'),

                    Relation::make('kinsman.kin_id')
                        ->fromModel(Kin::class, 'name', 'id')
                        ->title('Kinsman.Label.Kin'),

                    CheckBox::make('kinsman.active')
                        ->title(__('Kinsman.Label.Active'))
                        ->sendTrueOrFalse()
                        ->value(true),
                ]),

                Layout::rows([

                    DateTimer::make('life.birth_date')
                        ->title(__('Life.Label.BirthDate'))
                        ->placeholder(__('Life.Placeholder.BirthDate'))
                        ->value($this->kinsman->life->birth_date ?? null)
                        ->enableTime(),

                    DateTimer::make('life.end_date')
                        ->title(__('Life.Label.EndDate'))
                        ->placeholder(__('Life.Placeholder.EndDate'))
                        ->value($this->kinsman->life->end_date ?? null)
                        ->enableTime(),

                    Map::make('city.native')
                        ->title(__('City.Label.Native'))
                        ->zoom(4)
                        ->value([
                            'lat' => $coordinates->lat ?? 50,
                            'lng' => $coordinates->lng ?? 40,
                        ]),

                ]),

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
