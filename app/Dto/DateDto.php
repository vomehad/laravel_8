<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class DateDto implements DtoInterface
{
    public string $begin;
    public string $end;

    public function createFromRequest(array $fields, string $prefix = ''): DtoInterface
    {
        $array = $prefix ? Arr::get($fields, $prefix) : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        return $this;
    }
}
