<?php

namespace App\Models;

use App\Enums\Subject\SubjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends BaseModel
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'credit',
        'credit_practice',
        'subject_code',
        'department_id',
        'is_required',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => SubjectStatus::class,
    ];

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
