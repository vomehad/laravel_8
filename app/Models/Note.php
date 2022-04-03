<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    public string $name;
    public string $content;

    public $fillable = [
        'name',
        'content',
    ];
}
