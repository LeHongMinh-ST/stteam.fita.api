<?php

namespace App\Models;

use App\Enums\Tag\TagStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Tag extends BaseModel
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => TagStatus::class,
    ];


    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function slug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'slugable');
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

        self::deleting(function (Tag $model) {
            $model->posts()->detach();
            $model->slug()->delete();
        });
    }
}
