<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Note
 * @package App\Models
 *
 * @property int            $id
 * @property string         $name
 * @property string         $content
 * @property Note           $parentNote
 * @property Category       $category
 *
 * @method static find(int $id)
 */
class Note extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'content',
        'active',
    ];

    protected $allowedFilters = [
        'name',
        'content',
        'active',
    ];

    protected $allowedSorts = [
        'name',
        'content',
        'active',
    ];

    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function parentNote(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'parent_id', 'id')->withDefault([
            'active' => true,
            'parent_id' => null
        ]);
    }
}
