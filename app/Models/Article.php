<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
}
