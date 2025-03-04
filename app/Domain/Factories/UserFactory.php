<?php

namespace App\Domain\Factories;

use App\Application\DTOs\User\CreateUserDTO;
use App\Domain\Entities\Role;
use App\Domain\Entities\User;
use Illuminate\Support\Str;
use App\Infrastructure\Persistence\Models\User as UserModel;

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
            id: $userDTO->id ?? null,
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

    public static function fromModel(UserModel $userModel, ?Role $role): User
    {
        $roles = [];

        if ($userModel->roles->isNotEmpty()) {
            $roles = $userModel->roles;
        } elseif ($role !== null) {
            $roles = [ $role ];
        }

        return new User(
            $userModel->id,
            $userModel->name,
            $userModel->email,
            $userModel->phone_1,
            $userModel->password,
            $userModel->address,
            $roles,
            $userModel->phone_2,
            $userModel->is_active,
            $userModel->emergency_contacts,
            $userModel->birth_date,
            $userModel->email_verified_at
        );
    }
}
