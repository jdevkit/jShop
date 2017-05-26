<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RankRepository;
use App\models\Rank;
use App\Validators\RankValidator;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class RankRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RankRepositoryEloquent extends BaseRepository implements RankRepository, CacheableInterface
{
    use CacheableRepository;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Rank::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RankValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
