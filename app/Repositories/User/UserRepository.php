<?php

namespace App\Repositories\User;

use App\Repositories\Base\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
interface UserRepository extends BaseRepository
{
    public function getListData(array $data = []): LengthAwarePaginator|array|Collection;
}
