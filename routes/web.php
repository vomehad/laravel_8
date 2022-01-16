<?php

use App\Http\Controllers\ConfigController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home']);
Route::get('/welcome', [UserController::class, 'welcome']);

Route::get('/config', [ConfigController::class, 'getAll']);
Route::get('/config/{key}', [ConfigController::class, 'getByKey']);
