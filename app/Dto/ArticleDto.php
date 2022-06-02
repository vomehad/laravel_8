<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class ArticleDto implements DtoInterface
{
    public int $id;
    public string $title;
    public ?string $preview;
    public ?string $link;
    public bool $active;
    public array $category;
    public int $created_by;
    public string $text;
    public ?string $disk;

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
