<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('Test.')->prefix('v1')->group(function() {
    Route::post('/add-cookie', [UserController::class, 'addCookie'])->name('cookie');
    Route::get('/get-cookie', [UserController::class, 'getCookie'])->name('cookie-value');
    Route::post('/word', [UserController::class, 'processWord'])->name('word');
    Route::post('/text', [UserController::class, 'switchDates'])->name('text');
});
