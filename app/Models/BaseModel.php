<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = CarbonImmutable::now();
            $model->updated_at = CarbonImmutable::now();
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        static::updating(function (User $model) {
            $model->updated_at = CarbonImmutable::now();
            $model->updated_by = auth()->id();
        });
    }
}
