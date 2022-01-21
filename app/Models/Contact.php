<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    public static function tableName(): string
    {
        return 'contacts';
    }

    /**
     * The attributes that are mass assignable
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'subject',
        'message',
    ];

    /**
     * The attributes that should be hidden for serialization
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast
     *
     * @var array
     */
    protected $casts = [];
}
