<?php

namespace App\Orchid\Screens\Datetime;

use App\Http\Requests\DateRequest;
use App\Services\ExamService;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class DatetimeScreen extends Screen
{
    private ExamService $service;

    public function __construct(ExamService $service)
    {
        $this->service = $service;
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'DatetimeScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Datetime.Button.Diff'))
                ->method('showDiff')
                ->block()
                ->novalidate()
                ->icon('bag'),
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
            Layout::rows([

                DateTimer::make('begin')
                    ->title('begin')
                    ->enableTime()
                    ->format24hr(),

                DateTimer::make('end')
                    ->title('end')
                    ->enableTime()
                    ->format24hr(),

                Button::make('Submit')->method('buttonClickProcessing')->type(Color::INFO())

            ])->title('period'),

        ];
    }

    public function showDiff(DateRequest $request)
    {
        $dto = $request->createDto();

        $diff = $this->service->diffTwoDates($dto);
        dd(__METHOD__, $diff);
    }
}
