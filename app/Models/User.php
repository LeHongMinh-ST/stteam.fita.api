<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Hidden;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Lift;

    #[PrimaryKey]
    public int $id;

    #[Fillable]
    public string $username;

    #[Fillable]
    public string $full_name;


    #[Fillable]
    public string $email;

    #[Fillable]
    public ?string $phone;

    #[Fillable]
    #[Hidden]
    #[Cast('hashed')]
    public string $password;

    #[Fillable]
    public int $created_by;

    #[Fillable]
    public int $updated_by;

    #[Fillable]
    public ?int $role_id;

    #[Fillable]
    public ?int $department_id;

    #[Fillable]
    #[Cast('boolean')]
    #[Column(default: false)]
    public bool $is_super_admin;

    #[Fillable]
    #[Cast('boolean')]
    #[Column(default: true)]
    public bool $is_teacher;

    #[Hidden]
    #[Fillable]
    public ?string $remember_token;

    #[Fillable]
    #[Cast('datetime')]
    public ?CarbonImmutable $email_verified_at;

    public CarbonImmutable|string|null $created_at;

    public CarbonImmutable|string|null $updated_at;


    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        static::updating(function (User $model) {
            $model->updated_by = auth()->id();
        });
    }
}
