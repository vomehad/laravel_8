<?php

namespace App\Http\Controllers;

use App\Facades\CustomCookie;
use App\Http\Requests\AjaxRequest;
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

    public function getCookie(): array
    {
        return [
            'cookie_hourly' => CustomCookie::getCookie($this->hourlyCookie),
            'cookie_forever' => CustomCookie::getCookie($this->foreverCookie)
        ];
    }

    public function processWord()
    {
        return 0;
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
