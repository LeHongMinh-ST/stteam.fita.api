<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reward extends BaseModel
{
    use HasFactory;

    protected $table = 'rewards';

    protected $fillable = [
        'name',
        'relate_url',
        'created_by',
        'updated_by',
    ];



    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'teacher_reward');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public static function boot(): void
    {
        parent::boot();
        self::deleting(function (Reward $reward) {
            $reward->teachers()->detach();
        });
    }
}
