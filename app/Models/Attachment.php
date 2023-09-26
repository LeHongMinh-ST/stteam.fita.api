<?php

namespace App\Models;

use App\Enums\Attachment\AttachmentType;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Attachment extends BaseModel
{
    use HasFactory, Lift;

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $path;

    #[Fillable]
    #[Cast(AttachmentType::class)]
    public string $type;

    #[Fillable]
    public int $target_id;

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
}
