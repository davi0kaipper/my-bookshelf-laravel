<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getGenreAttribute($value)
    {
        return explode(', ', $value);
    }

    public function setGenreAttribute($genre)
    {
        $this->attributes['genre'] = implode(', ', $genre);
    }
}