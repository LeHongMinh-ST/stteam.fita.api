<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupPermission extends Model
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
