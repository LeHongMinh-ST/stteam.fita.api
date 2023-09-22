<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Hidden;
use WendellAdriel\Lift\Lift;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Lift;

    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public string $email;

    #[Fillable]
    #[Hidden]
    #[Cast('hashed')]
    public string $password;

    public string $remember_token;

    #[Cast('datetime')]
    public CarbonImmutable $email_verified_at;

    public CarbonImmutable $created_at;

    public CarbonImmutable $updated_at;


}
