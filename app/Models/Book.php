<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setGenreAttribute($genre)
    {
        $this->attributes['genre'] = implode(', ', $genre);
    }

    public function toFormattedArray()
    {
        $data = $this->attributes;

        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'author' => $data['author'],
            'number_of_pages' => $data['number_of_pages'],
            'genre' => explode(', ', $data['genre']),
            'is_national' => $data['is_national'] == 1 ? true : false,
            'publisher' => $data['publisher'],
            'description' => $data['description'],
            'cover' => $data['cover']
        ];
    }
}