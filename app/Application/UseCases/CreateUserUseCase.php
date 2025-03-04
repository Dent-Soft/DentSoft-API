<?php

namespace App\Application\UseCases;

use App\Application\Commands\CreateUserCommand;
use App\Application\UseCases\Interfaces\ICreateUserUseCase;
use App\Domain\Entities\User;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\IUserRepository;
use DomainException;
use Illuminate\Support\Facades\Hash;

class CreateUserUseCase implements ICreateUserUseCase
{
    public function __construct(private IUserRepository $userRepository)
    {
    }

    public function execute(CreateUserCommand $command): User
    {
        if (!filter_var($command->userDTO->email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('El email no es válido');
        }

        $command->userDTO->password = Hash::make($command->userDTO->password, [ 'rounds' => 12 ]);
        $user = UserFactory::create($command->userDTO);

        return $this->userRepository->create($user);
    }
}
