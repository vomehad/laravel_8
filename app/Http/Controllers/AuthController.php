<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        return view('login', [
            'title' => 'login',
//            'nav' => $this->nav,
        ]);
    }

    public function store(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        $formFields = $request->only(['email', 'password']);

        if (Auth::attempt($formFields)) {
            return redirect()->intended(route('Account'));
        }

        return redirect(route('Login'))->withErrors([
            'email' => 'Login Fault(',
        ]);
    }

    public function signUp()
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        return view('signUp', [
            'title' => 'Registration',
//            'nav' => $this->nav,
        ]);
    }

    public function create(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect(route('Account'));
        }

        if (User::where('email', $request->input('email'))->exists()) {
            return redirect(route('SignUp'))->withErrors([
                'email' => 'Already exist'
            ]);
        }

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
//        $user->save();
        if ($user->save()) {
            Auth::login($user);

            return redirect(route('Account'))->with('success', 'Login!1');
        }

        return redirect(route('SignUp'))->withErrors([
            'sign' => 'Аунтификация не удалась',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('Home'));
    }
}