<?php

namespace App\Models;

use App\Observers\ModelObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'user_name',
        'full_name',
        'email',
        'phone',
        'password',
        'created_by',
        'updated_by',
        'role_id',
        'department_id',
        'is_super_admin',
        'is_teacher',
        'remember_token',
        'social_id',
        'social_type',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_super_admin' => 'boolean',
        'is_teacher' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(self::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(self::class, 'updated_by');
    }

    public static function boot(): void
    {
        parent::boot();
        $class = get_called_class();
        $class::observe(new ModelObserver);
    }
}
