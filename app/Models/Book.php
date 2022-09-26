<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function getGenreAttribute($genre)
    // {
    //     $this->attributes['genre'] = explode(', ', $genre);
    // }

    public function setGenreAttribute($genre)
    {
        $this->attributes['genre'] = implode(', ', $genre);
    }
}