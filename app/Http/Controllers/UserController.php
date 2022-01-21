<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    private array $nav;

    public function __construct()
    {
        $this->nav = [
            ['url' => route('Home'), 'name' => "Home"],
            ['url' => route('Welcome'), 'name' => trans("welcome")],
            ['url' => route('Regex'), 'name' => trans("regex")],
        ];
    }

    public function welcome()
    {
        return view('welcome', [
            'title' => Route::getCurrentRoute()->getName(),
            'nav' => $this->nav,
        ]);
    }

    public function home()
    {
        $title = Lang::get('basic.home');

        return view('home', [
            'title' => $title,
            'nav' => $this->nav,
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

    public function create(MainRequest $request)
    {
        $contact = new Contact();
        $contact->username = $request->input('username');
        $contact->name = $request->name;
        $contact->email = $request->get('email');
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->route('Home')->with('success', 'Message uploaded');
    }
}
