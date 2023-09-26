<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    public function created(Model $model): void
    {
        $model->created_by = 1;
        $model->updated_by = 1;
        $model->save();
    }

    public function updated(Model $model): void
    {
        $model->updated_by = 1;
        $model->save();
    }
}
