<?php

use App\Http\Controllers\AlgorithmController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\KinController;
use App\Http\Controllers\KinsmanController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KinsmanController::class, 'index'])->name('home');

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return redirect()->back();
})->name('locale');

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'],'/kinsmans/search', [KinsmanController::class, 'search'])->name('kinsmans.search');
    Route::resource('kinsmans', KinsmanController::class);
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'],'/kins/search', [KinController::class, 'search'])->name('kins.search');
    Route::resource('kins', KinController::class);
});

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [GameController::class, 'createRecord']);
});

Route::name('test.')->prefix('/test')->group(function() {
    Route::get('/', [CookieController::class, 'testingPage'])->name('main');

    Route::resource('cookie', CookieController::class)->only(['index', 'store']);

    Route::prefix('/')->group(function() {
        Route::match(['get', 'post'],'/notes/search', [NoteController::class, 'search'])->name('notes.search');
        Route::resource('/notes', NoteController::class);
    });

//    Route::resource('/categories', CategoryController::class);
});

Route::prefix('/')->group(function() {
    Route::match(['get', 'post'], '/articles/search',[ArticleController::class, 'search'])->name('articles.search');
    Route::resource('/articles', ArticleController::class);
});

//Route::resource('tags', TagController::class);

//Route::prefix('/')->group(function() {
//    Route::resource('/users', UserController::class);
//    Route::match(['get', 'post'], '/users.search', [UserController::class, 'search'])->name('users.search');
//    Route::get('/users/roles/{id}', [UserController::class, 'roles'])->name('users.roles');
//});

Route::prefix('algorithm')->group(function() {
    Route::get('/bubble', [AlgorithmController::class, 'index'])->name('sort');
});
