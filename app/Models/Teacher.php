<?php

namespace App\Models;

use App\Enums\Teacher\TeacherEducationLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'avatar',
        'teaching_start',
        'teaching_end',
        'education_level',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'education_level' => TeacherEducationLevel::class,
    ];

    public function rewards(): BelongsToMany
    {
        return $this->belongsToMany(Reward::class, 'teacher_reward');
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'teacher_subject');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
