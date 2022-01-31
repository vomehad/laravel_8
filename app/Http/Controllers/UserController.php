<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Home'), 'name' => "Home"],
            ['url' => route('Game'), 'name' => trans("welcome")],
            ['url' => route('Regex'), 'name' => trans("regex")],
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

    public function useRegex(?string $word = ""): string
    {
        $title = Lang::get('basic.regex');

        $splitWord = preg_replace('/(.)/', "$1 ", $word);

        return view('regex', [
            'title' => $title,
            'nav' => $this->nav,
            'regex' => $splitWord,
        ]);
    }

    public function account()
    {
        dd('account');
    }
}
