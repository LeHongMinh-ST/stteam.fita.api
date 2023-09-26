<?php

namespace App\Models;

use App\Enums\Attachment\AttachmentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'path',
        'type',
        'target_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'type' => AttachmentType::class,
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
