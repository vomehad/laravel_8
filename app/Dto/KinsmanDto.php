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

    /** @var string|null $middle_name */
    public ?string $middle_name;

    /** @var string $gender */
    public string $gender;

    /** @var int|null $father_id */
    public ?int $father_id;

    /** @var int|null $mother_id */
    public ?int $mother_id;

    /** @var int|null $kin_id */
    public ?int $kin_id;

    /** @var string|null $birth_date */
    public ?string $birth_date;

    /** @var string|null $end_date */
    public ?string $end_date;

    /** @var int|null $native */
    public ?int $native;

    public function createFromRequest(array $fields): DtoInterface
    {
        $kinsman = Arr::has($fields, 'kinsman') ? Arr::get($fields, 'kinsman') : $fields;
        $life = Arr::has($fields, 'life') ? Arr::get($fields, 'life') : $fields;
        $city = Arr::has($fields, 'city') ? Arr::get($fields, 'city') : $fields;
        $array = array_merge($kinsman, $life, $city);

        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::has($array, $prop)) {
                $this->$prop = Arr::get($array, $prop);
            }
        }

        return $this;
    }
}
