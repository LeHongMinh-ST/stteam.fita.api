<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class GroupPermission extends BaseModel
{
    use HasFactory;

    protected $table = 'group_permissions';

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'group_code', 'code');
    }

}
