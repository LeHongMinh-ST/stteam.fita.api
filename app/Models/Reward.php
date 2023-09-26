<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Reward extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'rewards';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public string $relate_url;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;

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

    protected static function boot(): void
    {
        parent::boot();
        self::deleting(function (Reward $reward) {
            $reward->teachers()->detach();
        });
    }
}
