<?php

namespace App\Http\Controllers;

use App\Facades\CustomCookie;
use App\Helpers\Helper;
use App\Http\Requests\AjaxRequest;
use App\Http\Requests\SplitRequest;
use App\Http\Requests\TextRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class UserController extends Controller
{
    private string $hourlyCookie = 'hourly_cookie';
    private string $foreverCookie = 'forever_cookie';

    public function home()
    {
        $title = Lang::get('Main.' . Helper::getActionName());
        $contacts = Contact::all();

        return view('home', [
            'title' => $title,
            'nav' => $this->nav,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Start Page with forms
     *
     * @return string
     */
    public function testingPage(): string
    {
        $title = Lang::get(Helper::getActionName());

        $cookies = [
            'cookie_hourly' => $this->incrementCookie($this->hourlyCookie),
            'cookie_forever' => $this->incrementCookie($this->foreverCookie),
        ];

        return view('cookie.index', [
            'title' => $title,
            'cookies' => $cookies,
            'nav' => $this->nav,
        ]);
    }

    public function index()
    {
        $title = Lang::get(Helper::getActionName());
        $users = User::all();

        return view('user.index', [
            'title' => $title,
            'models' => $users,
            'nav' => $this->nav
        ]);
    }

    public function create()
    {
        $title = Lang::get(Helper::getActionName());
        $user = new User();

        return view('user.create', [
            'title' => $title,
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $user = $request->id ? User::find($request->id) : new User();
        $user->username = $request->get('username');
        $user->email = $request->get('email');

        return redirect()->route('User.View', [
            'id' => $user->id,
        ]);
    }

    public function show(int $id)
    {
        $user = User::find($id);

        return view('user.view', [
            'title' => $user->email,
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function edit(int $id): string
    {
        $title = Lang::get(Helper::getActionName());
        $user = User::find($id);

        return view('user.create', [
            'title' => $title . ' - ' . $user->email,
            'model' => $user,
            'nav' => $this->nav,
        ]);
    }

    public function destroy(int $id): string
    {
        $tag = User::find($id);
        $tag->delete();

        return Helper::getActionName();
    }

    public function search(Request $request)
    {
//        $string = $request->get('search') ?? $request->query->get('query') ?? '';
//        $title = Lang::get(Helper::getActionName());
//        $articles = $this->getArticleList($string);
//
//        return view('user.index', [
//            'title' => $title,
//            'models' => $articles,
//            'nav' => $this->nav,
//            'string' => $string,
//        ]);
    }

//    public function roles(int $id)
//    {
//        $user = User::find($id)->with('role')->get();
////        $user->role()->attach($roleId);
//    }

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
        $pattern = '/(\d{2})\.(\d{2})\.(\d{4})/';
        $replacement = '$1.$3.$2';

        return preg_replace($pattern, $replacement, $text);
    }

    public function account()
    {
        $title = Lang::get('Account');

        return view('auth.account', [
            'title' => $title,
            'nav' => $this->nav,
        ]);
    }

    private function incrementCookie(string $name): string
    {
        return CustomCookie::incrementCookie($name) ? CustomCookie::getCookie($name) : "not set";
    }
}
