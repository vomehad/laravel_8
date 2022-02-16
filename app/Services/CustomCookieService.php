<?php

namespace App\Services;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class CustomCookieService extends CookieJar
{
    private int $lifeTime = 5;

    public function setLifeTime(int $minutes): void
    {
        $this->lifeTime = $minutes;
    }

    public function getLifeTime(): int
    {
        return $this->lifeTime;
    }

    public function setCookie(string $name, string $value): Response
    {
        $response = new Response([$name, $value, Url::current()], 202);
        $response->withCookie(cookie($name, $value, $this->lifeTime, null, Url::current()));

        return $response;
    }

    public function getCookie(string $name)
    {
        return cookie($name);
    }
}
