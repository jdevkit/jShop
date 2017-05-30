<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Genre extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'genre'
    ];

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class, 'genres_books_pivot');
    }

}
