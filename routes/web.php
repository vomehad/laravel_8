<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('Home');

//Route::group(['prefix' => '/config'], function() {
//    Route::get('/', [ConfigController::class, 'getAll']);
//    Route::get('/{key}', [ConfigController::class, 'getByKey']);
//});

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

Route::name('Test.')->prefix('/test')->group(function() {
    Route::get('/', [UserController::class, 'testingPage'])->name('Main');

    Route::name('Note.')->prefix('/notes')->group(function() {
        Route::get('/', [NoteController::class, 'index'])->name('All');
        Route::get('/create', [NoteController::class, 'create'])->name('Create');
        Route::post('/store', [NoteController::class, 'store'])->name('Store');
        Route::match(['get', 'post'],'/search', [NoteController::class, 'search'])->name('Search');

        Route::prefix('{id}')->group(function () {
            Route::get('/', [NoteController::class, 'read'])->name('View');
            Route::get('/update/', [NoteController::class, 'update'])->name('Update');
            Route::delete('/delete', [NoteController::class, 'delete'])->name('Delete');
        });
    });

    Route::name('Category.')->prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'list'])->name('List');
        Route::get('/create', [CategoryController::class, 'create'])->name('New');
        Route::post('/store', [CategoryController::class, 'store'])->name('Store');
        Route::get('/{id}', [CategoryController::class, 'view'])->name('View');
    });
});

Route::name('Article.')->prefix('article')->group(function() {
    Route::get('/', [ArticleController::class, 'index'])->name('Main');
    Route::get('/create', [ArticleController::class, 'create'])->name('New');
    Route::post('/store', [ArticleController::class, 'store'])->name('Store');
    Route::match(['get', 'post'],'/search', [ArticleController::class, 'search'])->name('Search');
    Route::get('/{id}', [ArticleController::class, 'view'])->name('View');
    Route::get('/{id}/update', [ArticleController::class, 'update'])->name('Update');
    Route::delete('/{id}/delete', [ArticleController::class, 'delete'])->name('Delete');
});
