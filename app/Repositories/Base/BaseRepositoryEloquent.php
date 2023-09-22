<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 *
 */
abstract class BaseRepositoryEloquent implements BaseRepository
{
    /**
     * @var Model|Builder
     */
    protected Model|Builder $model;

    /**
     * @var Model
     */
    protected Model $originalModel;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }


    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }


    /**
     * @param $model
     * @return BaseRepository
     */
    public function setModel($model): BaseRepository
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return BaseRepository
     */
    public function resetModel(): BaseRepository
    {
        $this->model = new $this->originalModel;

        return $this;
    }

    /**
     * @param array $with
     * @return Model|Builder
     */
    public function make(array $with = []): Model|Builder
    {
        if (!empty($with)) {
            $this->model = $this->model->with($with);
        }

        return $this->model;
    }


    /**
     * @param array $columns
     * @param array $relations
     * @return Collection|array
     */
    public function all(array $columns = ['*'], array $relations = []): Collection|array
    {
        $data =  $this->model->with($relations)->get($columns);
        $this->resetModel();

        return $data;
    }


    /**
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return mixed
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): mixed
    {
        $this->make($relations);

        $data = $this->model->select($columns)->find($id);

        $this->resetModel();

        return $data;
    }

    /**
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload): mixed
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * @param int $id
     * @param array $payload
     * @return mixed
     */
    public function updateById(int $id, array $payload): mixed
    {
        $model = $this->findById($id);

        return $model->update($payload);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id): mixed
    {
        return $this->findById($id)->delete();
    }

    /**
     * @param array $condition
     * @param array $relations
     * @param array $columns
     * @return Collection|array
     */
    public function allBy(array $condition, array $relations = [], array $columns = ['*']): Collection|array
    {
        $this->applyConditions($condition);

        $data = $this->make($relations)->select($columns);

        $this->resetModel();

        return $data->get();
    }

    /**
     * @param array $condition
     * @param array $relations
     * @param array $columns
     * @param int $paginate
     * @return LengthAwarePaginator
     */
    public function getListPaginateBy(array $condition, array $relations = [], array $columns = ['*'], $paginate = 10): LengthAwarePaginator
    {
        $this->applyConditions($condition);

        $data =  $this->make($relations)->select($columns)->paginate($paginate);

        $this->resetModel();
        return $data;
    }

    /**
     * @param array $condition
     * @param array $columns
     * @param array $relations
     * @return mixed
     */
    public function getFirstBy(array $condition = [], array $columns = [], array $relations = []): mixed
    {
        $this->make($relations);
        $this->applyConditions($condition);

        $data = $this->model->select('*');
        if (!empty($columns)) {
            $data = $this->model->select($columns);
        }

        $this->resetModel();

        return $data->first();
    }

    /**
     * @param array $data
     * @param array $with
     * @return mixed
     */
    public function firstOrCreate(array $data, array $with = []): mixed
    {
        $data = $this->model->firstOrCreate($data, $with);

        $this->resetModel();

        return $data;
    }

    /**
     * @param $column
     * @param $key
     * @param array $condition
     * @return mixed
     */
    public function pluck($column, $key = null, array $condition = []): mixed
    {
        $this->applyConditions($condition);

        $select = [$column];
        if (!empty($key)) {
            $select = [$column, $key];
        }

        $data = $this->model->select($select);

        return $data->pluck($column, $key)->all();
    }

    /**
     * @param $data
     * @param array $condition
     * @return Model|bool
     */
    public function createOrUpdate($data, array $condition = []): Model|bool
    {
        if (is_array($data)) {
            $item = $this->getFirstBy($condition);
            if (empty($condition)) {
                $item = new $this->model;
            }

            if (empty($item)) {
                $item = new $this->model;
            }

            $item = $item->fill($data);
        } elseif ($data instanceof Model) {
            $item = $data;
        } else {
            return false;
        }

        $this->resetModel();
        if ($item->save()) {
            return $item;
        }

        return false;
    }


    /**
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    /**
     * @param array $condition
     * @return bool
     */
    public function deleteBy(array $condition = []): bool
    {
        $this->applyConditions($condition);

        $data = $this->model->get();

        if (empty($data)) {
            return false;
        }

        foreach ($data as $item) {
            $item->delete();
        }

        $this->resetModel();

        return true;
    }

    /**
     * @param array $condition
     * @return mixed
     */
    public function count(array $condition = []): mixed
    {
        $this->applyConditions($condition);

        $data = $this->model->count();

        $this->resetModel();

        return $data;
    }

    /**
     * @param $column
     * @param array $value
     * @param array $args
     * @return mixed
     */
    public function getByWhereIn($column, array $value = [], array $args = []): mixed
    {
        $data = $this->model->whereIn($column, $value);

        if (!empty(Arr::get($args, 'where'))) {
            $this->applyConditions($args['where']);
        }

        if (!empty(Arr::get($args, 'paginate'))) {
            return $data->paginate((int)$args['paginate']);
        } elseif (!empty(Arr::get($args, 'limit'))) {
            return $data->limit((int)$args['limit']);
        }

        $this->resetModel();

        return $data->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data): mixed
    {
        return $this->model->insert($data);
    }

    /**
     * @param array $condition
     * @param array $data
     * @return bool
     */
    public function update(array $condition, array $data): bool
    {
        $this->applyConditions($condition);
        $data = $this->model->update($data);

        $this->resetModel();

        return $data;
    }

    /**
     * @param array $where
     * @param $model
     * @return void
     */
    protected function applyConditions(array $where, &$model = null): void
    {
        if (!$model) {
            $newModel = $this->model;
        } else {
            $newModel = $model;
        }

        foreach ($where as $field => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                $newModel = match (strtoupper($condition)) {
                    'IN' => $newModel->whereIn($field, $val),
                    'NOT_IN' => $newModel->whereNotIn($field, $val),
                    'OR' => $newModel->where(function ($query) use ($field, $val) {
                        if (is_array($val)) {
                            foreach ($val as $item) {
                                $query = $query->orWhere(function ($q) use ($item) {
                                    [$field, $condition, $val] = $item;
                                    return match (strtoupper($condition)) {
                                        'IN' => $q->whereIn($field, $val),
                                        'NOT_IN' => $q->whereNotIn($field, $val),
                                        default => $q->where($field, $condition, $val),
                                    };
                                });
                            }
                        } else {
                            $query = $query->orWhere($field, $val);
                        }

                        return $query;
                    }),
                    'ORDER_BY' => $newModel->orderBy($field, $val),
                    default => $newModel->where($field, $condition, $val),
                };
            } else {
                $newModel = $newModel->where($field, $value);
            }
        }
        if (!$model) {
            $this->model = $newModel;
        } else {
            $model = $newModel;
        }
    }
}
