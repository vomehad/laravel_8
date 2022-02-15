<?php

namespace App\Services;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Response;

class CustomCookieService extends CookieJar
{
    public function setCookie(string $name, string $value)
    {
        $response = new Response();
        $response->with(cookie($name, $value));

        return $response;
    }
}
