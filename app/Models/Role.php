<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends BaseModel
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public static function boot(): void
    {
        parent::boot();

        self::deleting(function (Role $model) {
            $model->permissions()->detach();
        });
    }
}
