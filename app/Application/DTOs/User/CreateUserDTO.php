<?php

namespace App\Application\DTOs\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class CreateUserDTO
{
    private function __construct(
        public string $name,
        public string $email,
        public string $phone1,
        public ?string $phone2,
        public string $address,
        public ?array $emergencyContacts,
        public Carbon $birthDate,
        public string $password,
    ) {
    }

    public static function fromValidatedRequest(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['phone1'],
            $data['phone2'] ?? null,
            $data['address'],
            $data['emergency_contacts'] ?? [],
            Carbon::parse($data['birth_date']),
            Hash::make($data['password'], [ 'rounds' => 12 ]),
        );
    }
}
