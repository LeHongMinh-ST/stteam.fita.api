<?php

namespace App\Models;

use App\Observers\ModelObserver;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public static function boot(): void
    {
        parent::boot();

        $class = get_called_class();
        $class::observe(new ModelObserver);
    }
}
