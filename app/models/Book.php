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

}
