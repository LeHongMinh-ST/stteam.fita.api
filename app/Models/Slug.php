<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

final class Slug extends Model
{
    use HasFactory, Lift;

    protected $table = 'slugs';

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $content;

    #[Fillable]
    public int $slugable_id;

    #[Fillable]
    public string $slugable_type;

    public function slugable(): MorphTo
    {
        return $this->morphTo();
    }
}
