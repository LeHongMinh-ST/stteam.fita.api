<?php

namespace App\Models;

use App\Enums\Category\CategoryStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Category extends BaseModel
{
    use HasFactory, Lift;

    protected $table = 'categories';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public int $parent_id;

    #[Fillable]
    public int $depth;

    #[Fillable]
    #[Cast(CategoryStatus::class)]
    public string $status;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post');
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id')->with(['slug', 'parent']);
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->with(['slug', 'children']);
    }

    protected static function boot(): void
    {
        parent::boot();

        self::deleting(function (Category $category) {
            Category::where('parent_id', $category->id)->update(['parent_id' => null]);
            $category->posts()->detach();
        });
    }
}
