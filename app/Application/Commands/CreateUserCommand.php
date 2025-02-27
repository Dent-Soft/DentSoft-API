<?php

namespace App\Application\Commands;

use App\Application\DTOs\User\CreateUserDTO;

class CreateUserCommand
{
    public function __construct(public CreateUserDTO $userDTO)
    {
    }
}
