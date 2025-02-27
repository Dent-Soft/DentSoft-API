<?php

namespace App\Infrastructure\Providers;

use App\Application\Commands\CreateUserCommand;
use App\Application\Handlers\CreateUserHandler;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bindMethod(CreateUserHandler::class . '@handle', function ($handler, $command) {
            return $handler->handle($command);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Bus::map([
            CreateUserCommand::class => CreateUserHandler::class,
        ]);
    }
}
