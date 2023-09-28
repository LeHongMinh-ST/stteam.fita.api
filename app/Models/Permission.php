<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Lift;

class Permission extends Model
{
    use HasFactory, Lift;

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'code',
        'group_code',
        'description',
        'created_by',
        'updated_by',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    public static function boot(): void
    {
        parent::boot();

        static::deleting(function (Permission $model) {
            $model->roles()->detach();
        });
    }
}
