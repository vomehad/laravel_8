<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class CookieDto implements DtoInterface
{
    public ?int $numberHourly;
    public ?int $numberForever;

    public function createFromRequest(array $fields): DtoInterface
    {
        foreach (get_class_vars(self::class) as $prop => $item) {
                $this->$prop = Arr::get($fields, $prop);
        }

        return $this;
    }
}
