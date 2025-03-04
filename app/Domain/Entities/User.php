<?php

namespace App\Domain\Entities;

use App\Domain\Attributes\Getter;
use App\Domain\Attributes\Setter;
use App\Domain\Traits\AccessorTrait;
use Carbon\Carbon;

class User
{
    use AccessorTrait;

    public function __construct(
        #[Getter]
        private ?string $id,
        #[Getter]
        private string $name,
        #[Getter]
        private string $email,
        #[Getter]
        private string $phone1,
        #[Getter]
        private string $password,
        #[Getter]
        private string $address,
        /** @var Role[] */
        private ?array $roles = [],
        #[Getter]
        private ?string $phone2 = null,
        #[Getter]
        private bool $isActive = true,
        #[Getter]
        private ?array $emergencyContacts = [],
        #[Getter]
        private ?Carbon $birthDate = null,
        #[Getter]
        private ?Carbon $emailVerifiedAt = null,
    ) {
    }

    public function getRoles(): array
    {
        return array_map(fn(Role $role) => $role->toArray(), $this->roles ?? []);
    }

    public function toArray(): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone1'            => $this->phone1,
            'password'          => $this->password,
            'address'           => $this->address,
            'roles'             => $this->getRoles(),
            'phone2'            => $this->phone2,
            'isActive'          => $this->isActive,
            'emergencyContacts' => $this->emergencyContacts,
            'birthDate'         => $this->birthDate?->toDateString(),
            'emailVerifiedAt'   => $this->emailVerifiedAt?->toDateTimeString(),
        ];
    }
}
