<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('Home');
Route::get('/welcome', [UserController::class, 'welcome'])->name('Welcome');

Route::group(['prefix' => '/config'], function() {
    Route::get('/', [ConfigController::class, 'getAll']);
    Route::get('/{key}', [ConfigController::class, 'getByKey']);
});

Route::group(['prefix' => '/kinsman'], function() {
    Route::post('/create', [UserController::class, 'create'])->name('Create');
});

Route::get('/useRegex/{word?}', [UserController::class, 'useRegex']);
