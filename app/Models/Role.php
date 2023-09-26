<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Role extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'roles';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    #[Fillable]
    public CarbonImmutable|string|null $created_at;

    #[Fillable]
    public CarbonImmutable|string|null $updated_at;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function (Role $model) {
            $model->permissions()->detach();
        });
    }
}
