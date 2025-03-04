<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Entities\User;
use App\Domain\Factories\UserFactory;
use App\Domain\Repositories\IRoleRepository;
use App\Domain\Repositories\IUserRepository;
use App\Infrastructure\Persistence\Models\User as UserModel;
use DomainException;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements IUserRepository
{
    public function __construct(private readonly IRoleRepository $roleRepository)
    {
    }

    public function create(User $user): User
    {
        try {
            DB::beginTransaction();

            $guestRole = $this->roleRepository->findByName('guest');

            if (!$guestRole) {
                throw new DomainException('Role "guest" not found.');
            }

            $userModel = new UserModel();
            $userModel->name = $user->getName();
            $userModel->email = $user->getEmail();
            $userModel->phone_1 = $user->getPhone1();
            $userModel->phone_2 = $user->getPhone2();
            $userModel->address = $user->getAddress();
            $userModel->emergency_contacts = $user->getEmergencyContacts();
            $userModel->password = $user->getPassword();
            $userModel->birth_date = $user->getBirthDate();
            $userModel->save();

            $userModel->roles()->attach($guestRole->getId());

            DB::commit();

            return UserFactory::fromModel($userModel, $guestRole);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al crear usuario: ' . $e->getMessage());
            throw new \RuntimeException('Error en la base de datos');
        }
    }
}
