<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BookRepository;
use App\models\Book;
use App\Validators\BookValidator;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class BookRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository, CacheableInterface
{
    use CacheableRepository;

    protected $cacheOnly = ['all'];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BookValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
