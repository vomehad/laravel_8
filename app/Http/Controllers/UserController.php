<?php

namespace App\Http\Controllers;

use App\Facades\CustomCookie;
use App\Http\Requests\AjaxRequest;
use App\Http\Requests\SplitRequest;
use App\Http\Requests\TextRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private array $nav;

    private string $hourlyCookie = 'hourly_cookie';

    private string $foreverCookie = 'forever_cookie';

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Test.main'), 'name' => 'Testing page'],
            ['url' => route('Game'), 'name' => trans("welcome")],
        ];
    }

    public function home()
    {
        $title = Lang::get('basic.home');

        $contacts = Contact::all();

        return view('home', [
            'title' => $title,
            'nav' => $this->nav,
            'contacts' => $contacts
        ]);
    }

    /**
     * Start Page with forms
     *
     * @return string
     */
    public function testingPage(): string
    {
        $title = 'Testing page';

        $cookies = [
            'cookie_hourly' => $this->incrementCookie($this->hourlyCookie),
            'cookie_forever' => $this->incrementCookie($this->foreverCookie),
        ];

        return view('testing-page', [
            'title' => $title,
            'nav' => $this->nav,
            'cookies' => $cookies,
        ]);
    }

    /**
     * Set cookie value
     *
     * @param AjaxRequest $request
     * @return void
     */
    public function addCookie(AjaxRequest $request): void
    {
        $hourly = $request->input('numberHourly');
        $forever = $request->input('numberForever');

        if ($hourly) {
            $oneHour = 60;

            CustomCookie::setCookie($this->hourlyCookie, $hourly, $oneHour);
        }

        if ($forever) {
            CustomCookie::setCookie($this->foreverCookie, $forever);
        }
    }

    /**
     * Get new cookie`s value
     *
     * @return array
     */
    public function getCookie(): array
    {
        return [
            'cookie_hourly' => CustomCookie::getCookie($this->hourlyCookie),
            'cookie_forever' => CustomCookie::getCookie($this->foreverCookie)
        ];
    }

    /**
     * "Whitespaced" word
     *
     * @param SplitRequest $request
     * @return string
     */
    public function processWord(SplitRequest $request): string
    {
        $split = '';
        $wordSplit = $request->input('wordSplit');

        for ($char = 0; $char < mb_strlen($wordSplit); $char++) {
            $split .= mb_substr($wordSplit, $char, 1) . ' ';
        }

        return $split;
    }

    public function switchDates(TextRequest $request)
    {
        $text = $request->input('text');
        $pattern = '/(\d{2}\).(\d{2}\).(\d{4})/';
        $replacement = '$1.$3.$2';

        return preg_replace($pattern, $replacement, $text);
    }

    public function account()
    {
        $title = 'Account';
//        $title .= Auth::user();

        return view('account', [
            'title' => $title,
            'nav' => $this->nav,
        ]);
    }

    private function incrementCookie(string $name): string
    {
        return CustomCookie::incrementCookie($name) ? CustomCookie::getCookie($name) : "not set";
    }
}
