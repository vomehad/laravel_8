<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('Home');

Route::group(['prefix' => '/config'], function() {
    Route::get('/', [ConfigController::class, 'getAll']);
    Route::get('/{key}', [ConfigController::class, 'getByKey']);
});

Route::group(['prefix' => '/kinsman'], function() {
    Route::get('/create', [AuthController::class, 'signup'])->name('SignUp');
    Route::post('/create', [AuthController::class, 'create'])->name('Create');
    Route::get('/login', [AuthController::class, 'login'])->name('Login');
    Route::post('/store', [AuthController::class, 'store'])->name('Store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('Logout');

    Route::get('/account', [UserController::class, 'account'])->middleware('auth')->name('Account');
});

Route::get('/useRegex/{word?}', [UserController::class, 'useRegex'])->name('Regex');

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [UserController::class, 'createRecord']);
});

Route::name('Test.')->prefix('test')->group(function() {
    Route::post('/add-cookie', [UserController::class, 'addCookie'])->name('cookie');
    Route::get('/get-cookie', [UserController::class, 'getCookie'])->name('cookie-value');
    Route::get('/page', [UserController::class, 'testingPage'])->name('main');
    Route::post('/word', [UserController::class, 'processWord'])->name('word');
});
