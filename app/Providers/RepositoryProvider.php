<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\BaseRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider  extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepository::class,
            UserRepositoryEloquent::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
