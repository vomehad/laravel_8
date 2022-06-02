<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Kinsman
 *
 * @property int $id
 * @property string $name
 * @property string $middle_name
 * @property string $gender
 * @property Kinsman $father
 * @property Kinsman $mother
 * @property Kin $kin
 * @property bool $active
 * @package App\Models
 */
class Kinsman extends Model
{
    use HasFactory, Searchable, SoftDeletes, AsSource, Filterable;

    protected $table = 'kinsmans';

    protected $fillable = [
        'name',
        'middle_name',
        'gender',
        'father_id',
        'mother_id',
        'kin_id',
        'active',
    ];

    protected $allowedFilters = [
        'name',
        'middle_name',
        'gender',
        'active',
    ];

    protected $allowedSorts = [
        'name',
        'middle_name',
        'gender',
        'active',
    ];

    public function father(): BelongsTo
    {
        return $this->belongsTo(Kinsman::class)->withDefault([
            'gender' => 'male'
        ]);
    }

    public function mother(): BelongsTo
    {
        return $this->BelongsTo(Kinsman::class)->withDefault([
            'gender' => 'female'
        ]);
    }

    public function kin(): BelongsTo
    {
        return $this->BelongsTo(Kin::class);
    }

    public function scopeFathers(Builder $query): Builder
    {
        return $query->where(['gender' => 'male'])
            ->where(['active' => true])
            ->where('id', '!=', $this->id);
    }

    public function scopeMothers(Builder $query): Builder
    {
        return $query->where(['gender' => 'female'])
            ->where(['active' => true])
            ->where('id', '!=', $this->id);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name ." ". $this->middle_name;
    }
}
