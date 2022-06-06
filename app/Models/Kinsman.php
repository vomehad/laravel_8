<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Kinsman
 *
 * @property int        $id
 * @property string     $name
 * @property string     $middle_name
 * @property string     $gender
 * @property Kinsman    $father
 * @property Kinsman    $mother
 * @property Kin        $kin
 * @property bool       $active
 * @property Life       $life
 * @property City[]     $nativeCity
 *
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

//====================== relations =====================================
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

    public function life(): HasOne
    {
        return $this->hasOne(Life::class);
    }

    public function nativeCity(): BelongsToMany
    {
        return $this->belongsToMany(
            City::class,
            'life',
            'kinsman_id',
            'native_city_id'
        );
    }
// ============================= end relations ===================================

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

    public function scopeKinsman(Builder $query): Builder
    {
        return $query->where(['active' => true]);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name ." ". $this->middle_name;
    }

    public function getGender(string $key): string
    {
        $genders = [
            'male' => __('Kinsman.Select.Male'),
            'female' => __('Kinsman.Select.Female'),
        ];
        return $genders[$key];
    }
}
