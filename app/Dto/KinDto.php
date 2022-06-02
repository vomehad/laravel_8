<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class KinDto implements DtoInterface
{
    public int $id;
    public string $name;

    public function createFromRequest(array $fields): DtoInterface
    {
        $array = is_array(reset($fields)) ? reset($fields) : $fields;

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        return $this;
    }
}
