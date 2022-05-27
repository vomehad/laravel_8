<?php

namespace App\Dto;

use Illuminate\Support\Arr;

class KinsmanDto
{
    public int $id;
    public string $name;
    public string $middle_name;
    public string $gender;
    public int $father_id;
    public int $mother_id;
    public int $kin_id;

    public function createFromRequest(array $fields): KinsmanDto
    {
        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::get($fields, $prop)) {
                $this->$prop = Arr::get($fields, $prop);
            }
        }

        return $this;
    }
}
