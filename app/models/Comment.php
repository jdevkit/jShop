<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Comment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'text',
        'rank',
        'user_id',
        'book_id'
    ];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
