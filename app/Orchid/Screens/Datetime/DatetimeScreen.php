<?php

namespace App\Orchid\Screens\Datetime;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class DatetimeScreen extends Screen
{
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
        return [];
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
                Input::make('start_date')
                    ->type('datetime-local')
                    ->title('start date')
//                    ->value()
                    ->horizontal(),

                Input::make('finish_date')
                    ->type('datetime-local')
                    ->title('finish date')
//                    ->value()
                    ->horizontal(),

                Button::make('Submit')->method('buttonClickProcessing')->type(Color::INFO())
            ])->title('period'),

        ];
    }
}
