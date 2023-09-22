<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Column;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\Hidden;
use WendellAdriel\Lift\Lift;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Lift;

    public function __construct()
    {
        parent::__construct();
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }


    public int $id;

    #[Fillable]
    public string $name;

    #[Fillable]
    public string $email;

    #[Fillable]
    #[Hidden]
    #[Cast('hashed')]
    public string $password;

    #[Hidden]
    #[Fillable]
    public ?string $remember_token;

    #[Fillable]
    #[Cast('datetime')]
    public ?CarbonImmutable $email_verified_at;

    #[Fillable]
    public CarbonImmutable|string|null $created_at;

    #[Fillable]
    public CarbonImmutable|string|null $updated_at;


}
