<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

interface BaseRepository
{
    public function setModel($model);

    public function getModel();

    public function make(array $with = []);

    public function all(array $columns = ['*'], array $relations = []);

    public function allBy(array $condition, array $relations = [], array $columns = ['*']);

    public function getListPaginateBy(array $condition, array $relations = [], array $columns = ['*'], $paginate = 10);

    public function getFirstBy(array $condition = [], array $columns = [], array $relations = []);

    public function firstOrCreate(array $data, array $with = []);

    public function findById(int $id, array $columns = ['*'], array $relations = []);

    public function pluck($column, $key = null, array $condition = []);

    public function create(array $payload);

    public function createOrUpdate($data, array $condition = []);

    public function updateById(int $id, array $payload);

    public function update(array $condition, array $data);

    public function delete(Model $model);

    public function deleteById(int $id);

    public function deleteBy(array $condition = []);

    public function count(array $condition = []);

    public function getByWhereIn($column, array $value = [], array $args = []);

    public function insert(array $data);
}
