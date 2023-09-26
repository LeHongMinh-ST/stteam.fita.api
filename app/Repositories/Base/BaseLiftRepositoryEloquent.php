<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;

abstract class BaseLiftRepositoryEloquent extends BaseRepositoryEloquent implements BaseRepository
{
    /**
     * @param array $payload
     * @return mixed
     */
    public function create(array $payload): mixed
    {
        $model = $this->model->castAndCreate($payload);

        return $model->fresh();
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

            $item = $item->castAndFill($data);
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
     * @param array $condition
     * @param array $data
     * @return bool
     */
    public function update(array $condition, array $data): bool
    {
        $this->applyConditions($condition);
        $data = $this->model->castAndUpdate($data);

        $this->resetModel();

        return $data;
    }

}
