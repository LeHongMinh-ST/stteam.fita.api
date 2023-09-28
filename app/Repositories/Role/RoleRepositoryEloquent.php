<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\Base\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use JetBrains\PhpStorm\Pure;

class RoleRepositoryEloquent extends BaseRepositoryEloquent implements RoleRepository
{
    #[Pure] public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getListData(array $data = []): LengthAwarePaginator|array|Collection
    {
        $query = $this->model->query();
        $limit = !empty($data['limit']) ? (int)$data['limit'] : config('constants.limit_of_paginate', 10);

        $sort = !empty($data['sort']) ? $data['sort'] : 'DESC';

        $search = !empty($data['q']) ? $data['q'] : '';

        $query->when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })->with(['createdBy' => function ($query) {
            $query->select('id', 'full_name');
        }, 'updatedBy' => function ($query) {
            $query->select('id', 'full_name');
        }, 'permissions' => function ($query) {
            $query->select('permissions.id', 'name', 'code');
        }])->orderBy('created_at', $sort);

        return isset($data['page']) ? $query->paginate($limit) : $query->get();
    }
}
