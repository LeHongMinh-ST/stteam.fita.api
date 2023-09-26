<?php

namespace App\Models;

use App\Enums\Post\PostStatus;
use App\Enums\Post\PostType;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Post extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'posts';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $title;

    #[Fillable]
    public string $content;

    #[Fillable]
    #[Cast(PostType::class)]
    public string $type;

    #[Fillable]
    public int $department_id;

    #[Fillable]
    public int $feature_id;

    #[Fillable]
    public int $teacher_id;

    #[Fillable]
    #[Cast(PostStatus::class)]
    public string $status;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;

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

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function (Post $model) {
            $model->categories()->detach();
            $model->tags()->detach();
            $model->slug()->delete();
        });
    }
}
