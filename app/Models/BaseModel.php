<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected static function boot(): void
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        self::updating(function (User $model) {
            $model->updated_by = auth()->id();
        });
    }
}
