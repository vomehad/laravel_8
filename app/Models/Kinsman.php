<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kinsman
 *
 * @property int $id
 * @property string $name
 * @package App\Models
 */
class Kinsman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kinsmans';

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
}
