<?php

namespace App\Models;

use App\Enums\Semester\SemesterStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Semester extends BaseModel
{
    use HasFactory;

    protected $table = 'semesters';

    protected $fillable = [
        'position',
        'start_year',
        'end_year',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => SemesterStatus::class,
    ];

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

    public static function boot(): void
    {
        parent::boot();
        self::deleting(function (Semester $semester) {
            $semester->subjects()->detach();
        });
    }
}
