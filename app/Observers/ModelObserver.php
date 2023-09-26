<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class ModelObserver
{
    public function created(Model $model): void
    {
        if (auth()->check()) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
            $model->save();
        }

    }

    public function updated(Model $model): void
    {
        if (auth()->check()) {
            $model->updated_by = auth()->id();
            $model->save();
        }
    }
}
