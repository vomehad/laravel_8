<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Note extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    public $fillable = [
        'name',
        'content',
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
