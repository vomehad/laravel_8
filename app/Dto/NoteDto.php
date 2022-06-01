<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class NoteDto implements DtoInterface
{
    public int $id;
    public string $name;
    public array $category;
    public ?int $parent_id;
    public string $content;

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
