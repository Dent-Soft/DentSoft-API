<?php

namespace App\Application\UseCases\Interfaces;

use App\Application\Commands\CreateUserCommand;
use App\Domain\Entities\User;

interface ICreateUserUseCase
{
    public function execute(CreateUserCommand $command): User;
}
