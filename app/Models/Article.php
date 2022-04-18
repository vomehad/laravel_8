<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use HasFactory, Searchable;

//    protected $fillable = [
//        'title',
//        'text',
//    ];

    public function getPreview(int $long = 512): string
    {
        $pattern = '/\.([^.]*)$/';
        $previewText = mb_substr(strip_tags($this->text), 0, $long);

        return preg_replace($pattern, '.', $previewText);
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
