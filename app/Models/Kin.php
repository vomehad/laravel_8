<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kin
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $generation
 * @property int $created_by
 * @package App\Models
 */
class Kin extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kins';

    public function kinsman(): HasMany
    {
        return $this->HasMany(Kinsman::class);
    }
}
