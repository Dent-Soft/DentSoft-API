<?php

namespace App\Infrastructure\Providers;

use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\Interfaces\ICreateUserUseCase;
use Illuminate\Support\ServiceProvider;

class UseCaseProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ICreateUserUseCase::class, CreateUserUseCase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
