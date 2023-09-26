<?php

namespace App\Models;

use App\Enums\Department\DepartmentStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Department extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'departments';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    #[Cast(DepartmentStatus::class)]
    public string $status;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;



    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scientificResearches(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_scientific_research');
    }

    protected static function boot(): void
    {
        parent::boot();
        self::deleting(function(Department $department) {
            $department->scientificResearches()->detach();
        });
    }
}
