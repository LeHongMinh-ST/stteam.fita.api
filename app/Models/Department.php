<?php

namespace App\Models;

use App\Enums\Department\DepartmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use WendellAdriel\Lift\Lift;

class Department extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'code',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => DepartmentStatus::class,
    ];

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

    public static function boot(): void
    {
        parent::boot();
        self::deleting(function(Department $department) {
            $department->scientificResearches()->detach();
        });
    }
}
