<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class KinsmanDto implements DtoInterface
{
    /** @var int $id */
    public int $id;

    /** @var string $name */
    public string $name;

    /** @var string $middle_name */
    public string $middle_name;

    /** @var string $gender */
    public string $gender;

    /** @var int $father_id */
    public int $father_id;

    /** @var int $mother_id */
    public int $mother_id;

    /** @var int $kin_id */
    public int $kin_id;

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
