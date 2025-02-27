<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\UserRepository;

class CreateUserHandler
{
    // public function __construct(private UserRepository $userRepository)
    // {
    // }

    public function handle(CreateUserCommand $command)
    {
        // if ($this->userRepository->findByEmail($command->userDTO->email)) {
        //     throw new Exception("El email ya está registrado.");
        // }

        $user = UserFactory::create($command->userDTO);

        return $user->toArray();
        // $this->userRepository->save($user);
    }
}
