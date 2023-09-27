<?php

namespace App\Repositories\GroupPermission;

use App\Models\GroupPermission;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryEloquent;
use JetBrains\PhpStorm\Pure;

class GroupPermissionRepositoryEloquent extends BaseRepositoryEloquent implements GroupPermissionRepository
{
    #[Pure] public function __construct(GroupPermission $model)
    {
        parent::__construct($model);
    }
}
