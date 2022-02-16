<?php

namespace App\Facades;

use App\Services\CustomCookieService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void setLifeTime(int $minutes)
 * @method static int getLifeTime()
 * @method static \Illuminate\Http\Response setCookie(string $name, string $value)
 * @method static string getCookie(string $name)
 * @see \App\Services\CustomCookieService
 */
class CustomCookie extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomCookieService::class;
    }
}
