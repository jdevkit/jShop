<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Book extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'title',
        'description',
        'image',
        'date',
        'price',
        'file'
    ];

    public $timestamps = false;

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'authors_books_pivot', 'book_id','author_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genres_books_pivot');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function rank()
    {
        $comments = $this->comments;
        $totalRank = 0;
        $rankedComments = 0;
        foreach ($comments as $comment){
            if ($comment->rank){
                $rankedComments ++;
                $totalRank += $comment->rank;
            }
        }
        if ($rankedComments){
            return round($totalRank / $rankedComments, 1);
        }
        return 0;
    }

}
