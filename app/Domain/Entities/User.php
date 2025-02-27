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
        #[Getter] #[Setter]
        private string $id,
        #[Getter] #[Setter]
        private string $name,
        #[Getter] #[Setter]
        private string $email,
        #[Getter] #[Setter]
        private string $phone1,
        #[Getter] #[Setter]
        private string $password,
        #[Getter] #[Setter]
        private string $address,
            /** @var Role[] */
        #[Setter]
        private ?array $roles = [],
        #[Getter] #[Setter]
        private ?string $phone2 = null,
        #[Getter] #[Setter]
        private bool $isActive = true,
        #[Getter] #[Setter]
        private ?array $emergencyContacts = [],
        #[Getter] #[Setter]
        private ?Carbon $birthDate = null,
        #[Getter] #[Setter]
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
