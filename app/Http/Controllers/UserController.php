<?php

namespace App\Http\Controllers;

use App\Facades\CustomCookie;
use App\Http\Requests\AjaxRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private array $nav;
    private string $nameCookie = 'user_cookie';

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

        $cookie = CustomCookie::incrementCookie($this->nameCookie) ? CustomCookie::getCookie($this->nameCookie) : "not set";

        return view('testing-page', [
            'title' => $title,
            'nav' => $this->nav,
            'cookie' => $cookie,
        ]);
    }

    public function addCookie(AjaxRequest $request): void
    {
        $cookieNumber = $request->input('number');

        CustomCookie::setCookie($this->nameCookie, $cookieNumber, 60);
    }

    public function getCookie(): string
    {
        $cookie = CustomCookie::getCookie($this->nameCookie);
        $allCookie = cookie($this->nameCookie);
        $content = $cookie . " - " . $allCookie . PHP_EOL;

        file_put_contents("1.txt", $content, FILE_APPEND);

        return $cookie;
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
}
