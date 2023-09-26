<?php

namespace App\Models;

use App\Enums\ScientificResearch\ScientificResearchStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScientificResearch extends BaseModel
{
    use HasFactory;

    protected $table = 'scientific_researches';

    protected $fillable = [
        'name',
        'attachment_id',
        'department_id',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => ScientificResearchStatus::class,
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(ScientificResearch::class,'department_scientific_research');
    }

    public static function boot(): void
    {
        parent::boot();
        self::deleting(function (ScientificResearch $scientificResearch) {
            $scientificResearch->departments()->detach();
        });
    }
}
