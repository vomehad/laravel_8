<?php

namespace App\Orchid\Screens\Datetime;

use App\Http\Requests\DateRequest;
use App\Services\ExamService;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Toast;
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

            ModalToggle::make(__('Datetime.Button.Modal'))
                ->modal('diffTime')
                ->method('showDiff')
                ->icon('full-screen'),
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

                DateTimer::make('begin')->title('begin')->enableTime()->format24hr(),

                DateTimer::make('end')->title('end')->enableTime()->format24hr(),

                Button::make('showDiff')
                    ->modal('diffTime')
                    ->method('showDiff')
                    ->type(Color::INFO())

            ])->title('period'),

            Layout::modal(
                'diffTime',
                Layout::rows([

                    Code::make('begin'),

                    Code::make('end'),

                ])
            )->title(__('Datetime.Modal.Title'))
                ->size(Modal::SIZE_LG)
                ->withoutApplyButton(),

            Layout::block(
/*                Layout::view('platform::layouts.modal', [
                    'apply' => __('Datetime.Model.Apply'),
                    'close' => false,
                    'size' => '',
                    'type' => Modal::TYPE_CENTER,
                    'key' => __('Datetime.Model.Title'),
                    'title' => __('Datetime.Model.Title'),
                    'turbo' => true,
                    'commandBar' => [],
                    'withoutApplyButton' => false,
                    'withoutCloseButton' => false,
                    'open' => false,
                    'method' => null,
                    'staticBackdrop' => false,
                    'templateSlug' => '',
                    'asyncEnable' => false,
                    'asyncRoute' => false,
                    'manyForms' => [],
                ]),*/
                (new Modal(__('Datetime.Model.Title')))
            )

        ];
    }

    public function showDiff(DateRequest $request)
    {
        $dto = $request->createDto();

        [$begin, $end, $days, $month, $years] = $this->service->diffTwoDates($dto);

        Toast::info(json_encode($begin));
//        Toast::success(json_encode($end));
//        Toast::error($days);
//        Toast::warning($month);
//        Toast::info($years);

//        return $begin;
    }

    public function showDiffs(DateRequest $request)
    {
        $dto = $request->createDto();

        [$begin, $end, $days, $month, $years] = $this->service->diffTwoDates($dto);

        Toast::info(json_encode($begin));
        //        Toast::success(json_encode($end));
        //        Toast::error($days);
        //        Toast::warning($month);
        //        Toast::info($years);

        //        return $begin;
    }
}
