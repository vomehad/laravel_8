<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/welcome', [UserController::class, 'welcome'])->name('welcome');

Route::get('/config', [ConfigController::class, 'getAll']);
Route::get('/config/{key}', [ConfigController::class, 'getByKey']);
