<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Application\UseCases\Interfaces\ICreateUserUseCase;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class CreateUserHandler
{
    public function __construct(private readonly ICreateUserUseCase $useCase)
    {
    }

    public function handle(CreateUserCommand $command)
    {
        try {
            return $this->useCase->execute($command);
        } catch (\DomainException $e) {
            throw $e;
        } catch (\Throwable $e) {
            Log::error('Error en CreateUserHandler@handle: ' . $e->getMessage());
            throw new RuntimeException('Error al crear el usuario.');
        }
    }
}
