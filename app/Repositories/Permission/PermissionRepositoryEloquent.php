<?php

namespace App\Repositories\Permission;

use App\Models\Permission;
use App\Repositories\Base\BaseRepositoryEloquent;
use JetBrains\PhpStorm\Pure;

class PermissionRepositoryEloquent extends BaseRepositoryEloquent implements PermissionRepository
{
    #[Pure] public function __construct(Permission $model)
    {
        parent::__construct($model);
    }
}
