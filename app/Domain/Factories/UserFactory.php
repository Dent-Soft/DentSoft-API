<?php

namespace App\Domain\Factories;

use App\Application\DTOs\User\CreateUserDTO;
use App\Domain\Entities\User;
use Illuminate\Support\Str;

class UserFactory
{
    /**
     * Creates a new instance of the User entity from a DTO.
     *
     * @param CreateUserDTO $userDTO Data transfer object with user information.
     * @return User
     */
    public static function create(CreateUserDTO $userDTO): User
    {
        return new User(
            id: $userDTO->id ?? Str::uuid()->toString(),
            name: $userDTO->name,
            email: $userDTO->email,
            phone1: $userDTO->phone1,
            password: $userDTO->password,
            address: $userDTO->address,
            roles: $userDTO->roles ?? [],
            phone2: $userDTO->phone2,
            isActive: $userDTO->isActive ?? true,
            emergencyContacts: $userDTO->emergencyContacts,
            birthDate: $userDTO->birthDate,
            emailVerifiedAt: null,
        );
    }
}
