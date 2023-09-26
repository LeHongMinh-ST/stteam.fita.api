<?php

namespace App\Models;

use App\Enums\Subject\SubjectStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;

final class Subject extends BaseModel
{
    use HasFactory;

    protected $table = 'subjects';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public int $credit;

    #[Fillable]
    public int $credit_practice;

    #[Fillable]
    public string $subject_code;

    #[Fillable]
    public int $department_id;

    #[Fillable]
    #[Cast('boolean')]
    public bool $is_required;

    #[Fillable]
    #[Cast(SubjectStatus::class)]
    public string $status;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    #[Fillable]
    public CarbonImmutable|string|null $created_at;

    #[Fillable]
    public CarbonImmutable|string|null $updated_at;

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subject');
    }

    public function semester(): BelongsToMany
    {
        return $this->belongsToMany(Semester::class, 'semester_subject');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function (Subject $subject) {
            $subject->semester()->detach();
            $subject->teachers()->detach();
        });
    }
}
