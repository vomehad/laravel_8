<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

class Helper
{
    public static function getActionName(string $param = 'as'): string
    {
        return Arr::get(request()->route()->action, $param);
    }
}
