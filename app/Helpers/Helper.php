<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class Helper
{
    public static function getAction(string $param = 'as'): string
    {
        return Arr::get(request()->route()->action, $param);
    }
}
