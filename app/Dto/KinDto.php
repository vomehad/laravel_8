<?php

namespace App\Dto;

use Illuminate\Support\Arr;

class KinDto
{
    public int $id;
    public string $name;

    public function createFromRequest(array $fields): KinDto
    {
        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::get($fields, $prop)) {
                $this->$prop = Arr::get($fields, $prop);
            }
        }

        return $this;
    }
}
