<?php

namespace App\Models;

use App\Enums\ScientificResearch\ScientificResearchStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class ScientificResearch extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'scientific_researches';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public int $attachment_id;

    #[Fillable]
    public int $department_id;

    #[Fillable]
    #[Cast(ScientificResearchStatus::class)]
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

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(ScientificResearch::class,'department_scientific_research');
    }

    protected static function boot(): void
    {
        parent::boot();
        self::deleting(function (ScientificResearch $scientificResearch) {
            $scientificResearch->departments()->detach();
        });
    }
}
