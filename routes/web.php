<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('Home');

Route::group(['prefix' => '/kinsman'], function() {
    Route::get('/create', [AuthController::class, 'signup'])->name('SignUp');
    Route::post('/create', [AuthController::class, 'create'])->name('Create');
    Route::match(['get', 'post'],'/login', [AuthController::class, 'login'])->name('Login');
    Route::post('/store', [AuthController::class, 'store'])->name('Store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('Logout');

    Route::get('/account', [UserController::class, 'account'])->middleware('auth')->name('Account');
});

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [UserController::class, 'createRecord']);
});

Route::name('test.')->prefix('/test')->group(function() {
    Route::get('/', [UserController::class, 'testingPage'])->name('main');

    Route::prefix('/')->group(function() {
        Route::resource('notes', NoteController::class);
        Route::match(['get', 'post'],'/notes/search', [NoteController::class, 'search'])->name('notes.search');
    });

    Route::resource('categories', CategoryController::class);
});

Route::prefix('/')->group(function() {
    Route::resource('/articles', ArticleController::class);
    Route::match(['get', 'post'], '/articles/search',[ArticleController::class, 'search'])->name('articles.search');
});

Route::resource('tags', TagController::class);

Route::prefix('/')->group(function() {
    Route::resource('/users', UserController::class);
//    Route::match(['get', 'post'], '/users.search', [UserController::class, 'search'])->name('users.search');
    Route::get('/users/roles/{id}', [UserController::class, 'roles'])->name('users.roles');
});
