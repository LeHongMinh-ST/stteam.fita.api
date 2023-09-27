<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    public function creating(Model $model): void
    {
        if (!$model->isDirty('created_by')) {
            $model->created_by = auth()->id();
        }
        if (!$model->isDirty('updated_by')) {
            $model->updated_by = auth()->id();
        }
    }

    public function updating(Model $model): void
    {
        if (!$model->isDirty('updated_by')) {
            $model->updated_by = auth()->id();
        }
    }
}
