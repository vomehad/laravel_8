<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Life
 *
 * @property int $id
 * @property Kinsman $kinsman
 * @property string $birth_date
 * @property string $end_date
 * @property boolean $active
 *
 * @package App\Models
 */
class Life extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $table = 'life';

    protected $fillable = [];

    protected $allowedFilters = [];

    protected $allowedSorts = [];

    public function kinsman(): BelongsTo
    {
        return $this->belongsTo(Kinsman::class);
    }
}
