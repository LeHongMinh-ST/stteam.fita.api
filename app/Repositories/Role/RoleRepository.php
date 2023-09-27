<?php

namespace App\Repositories\Role;

use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoleRepository extends BaseRepository
{
    public function getListData(array $data = []): LengthAwarePaginator|array|Collection;
}
