<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory, Searchable;

    public function article(): BelongsToMany
    {
        return $this->belongsToMany(Article::class);
    }

    public function note(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }

    public static function getAll()
    {
        return self::select(['id', 'name'])
            ->where(['is_active' => true])
            ->where(['is_deleted' => false])
            ->get();
    }
}
