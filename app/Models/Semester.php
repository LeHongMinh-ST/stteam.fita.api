<?php

namespace App\Models;

use App\Enums\Semester\SemesterStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;

final class Semester extends BaseModel
{
    use HasFactory;

    protected $table = 'semesters';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public int $position;

    #[Fillable]
    public int $start_year;

    #[Fillable]
    public int $end_year;

    #[Fillable]
    #[Cast(SemesterStatus::class)]
    public string $status;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    #[Fillable]
    public CarbonImmutable|string|null $created_at;

    #[Fillable]
    public CarbonImmutable|string|null $updated_at;

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'semester_subject');
    }

    protected static function boot(): void
    {
        parent::boot();
        self::deleting(function (Semester $semester) {
            $semester->subjects()->detach();
        });
    }
}
