<?php

namespace App\models;

use Zizaco\Entrust\EntrustPermission;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Permission extends EntrustPermission
{
    use EntrustUserTrait;
}
