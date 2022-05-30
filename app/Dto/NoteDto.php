<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class NoteDto implements DtoInterface
{
    public int $id;
    public string $name;
    public array $category;
    public int $parent_id;
    public string $content;

    public function createFromRequest(array $fields): DtoInterface
    {
        foreach (get_class_vars(self::class) as $prop => $item) {
            if (Arr::get($fields, $prop)) {
                $this->$prop = Arr::get($fields, $prop);
            }
        }

        return $this;
    }
}
