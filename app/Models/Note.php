<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Note extends Model
{
    use HasFactory, Searchable;

    public $fillable = [
        'name',
        'content',
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
