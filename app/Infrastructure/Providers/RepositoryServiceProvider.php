<?php

namespace App\Infrastructure\Providers;

use App\Domain\Repositories\IRoleRepository;
use App\Domain\Repositories\IUserRepository;
use App\Infrastructure\Persistence\Repositories\RoleRepository;
use App\Infrastructure\Persistence\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
