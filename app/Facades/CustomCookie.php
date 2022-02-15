<?php

namespace App\Facades;

use App\Services\CustomCookieService;
use Illuminate\Support\Facades\Facade;

class CustomCookie extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomCookieService::class;
    }
}
