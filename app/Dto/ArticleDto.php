<?php

namespace App\Dto;

use App\Interfaces\DtoInterface;
use Illuminate\Support\Arr;

class ArticleDto implements DtoInterface
{
    public int $id;
    public string $title;
    public string $link;
    public array $category;
    public string $text;
    public $file;

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
