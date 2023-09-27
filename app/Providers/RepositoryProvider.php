<?php

namespace App\Providers;

use App\Repositories\GroupPermission\GroupPermissionRepository;
use App\Repositories\GroupPermission\GroupPermissionRepositoryEloquent;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Permission\PermissionRepositoryEloquent;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Role\RoleRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
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

        $this->app->bind(
            RoleRepository::class,
            RoleRepositoryEloquent::class
        );

        $this->app->bind(
            PermissionRepository::class,
            PermissionRepositoryEloquent::class
        );

        $this->app->bind(
            GroupPermissionRepository::class,
            GroupPermissionRepositoryEloquent::class
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
