<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Author extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'biography'
    ];

    public function book()
    {
        return $this->belongsToMany(Book::class,'authors_books_pivot', 'author_id','book_id');
    }

}
