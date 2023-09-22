<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Base\BaseRepositoryEloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }


    public function getListData(array $data = []): LengthAwarePaginator|array|Collection
    {
        $query = $this->model->query();

        $limit = !empty($data['limit']) ? (int)$data['limit'] : Config::get('constants.limit_of_paginate', 10);

        $sort = !empty($data['sort']) ? $data['sort'] : 'DESC';

        $search = !empty($data['q']) ? $data['q'] : '';

        $query
            ->when(!empty($search), function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orderBy('created_at', $sort);

        return isset($data['page']) ? $query->paginate($limit) : $query->get();
    }
}
