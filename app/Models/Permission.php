<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

class Permission extends BaseModel
{
    use HasFactory, Lift;

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public string $code;

    #[Fillable]
    public string $group_code;

    #[Fillable]
    public string $description;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    protected static function boot(): void
    {
        parent::boot();
    }
}
