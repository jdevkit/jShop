<?php

namespace App\Repositories\Eloquent;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AuthorRepository;
use App\models\Author;
use App\Validators\AuthorValidator;

/**
 * Class AuthorRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class AuthorRepositoryEloquent extends BaseRepository implements AuthorRepository, CacheableInterface
{
    use CacheableRepository;

    protected $cacheOnly = ['all'];

    public function __construct(Application $app)
    {
        $this->photoPath = public_path('/img/authors');
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Author::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AuthorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
