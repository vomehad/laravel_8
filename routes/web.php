<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('Home');

Route::group(['prefix' => '/config'], function() {
    Route::get('/', [ConfigController::class, 'getAll']);
    Route::get('/{key}', [ConfigController::class, 'getByKey']);
});

Route::group(['prefix' => '/kinsman'], function() {
    Route::post('/create', [UserController::class, 'create'])->name('Create');
});

Route::get('/useRegex/{word?}', [UserController::class, 'useRegex'])->name('Regex');

Route::group(['prefix' => '/game'], function() {
    Route::get('/', [GameController::class, 'playGame'])->name('Game');
    Route::post('/create', [UserController::class, 'createRecord']);
});
