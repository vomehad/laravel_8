<?php

namespace App\Http\Controllers;

use App\Http\Requests\AjaxRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private array $nav;

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

        return view('testing-page', [
            'title' => $title,
            'nav' => $this->nav,
        ]);
    }

    public function addCookie(AjaxRequest $request): string
    {
        $cookieNumber = $request->number;

        return response()->json($cookieNumber);
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
