<?php

namespace App\Models;

use App\Enums\Post\PostStatus;
use App\Enums\Post\PostType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Post extends BaseModel
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'type',
        'department_id',
        'feature_id',
        'teacher_id',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'type' => PostType::class,
        'status' => PostStatus::class,
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
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

        self::deleting(function (Post $model) {
            $model->categories()->detach();
            $model->tags()->detach();
            $model->slug()->delete();
        });
    }
}
