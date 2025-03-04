<?php

namespace App\Domain\Entities;

use App\Domain\Attributes\Getter;
use App\Domain\Attributes\Setter;
use App\Domain\Traits\AccessorTrait;

class Role
{
    use AccessorTrait;

    public function __construct(
        #[Getter]
        private ?string $id,
        #[Getter]
        private ?string $name,
        #[Getter]
        private ?string $displayName,
        #[Getter]
        private ?string $description,
            /** @var Permission[] */
        #[Getter]
        private ?array $permissions
    ) {
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'permissions' => array_map(fn(Permission $permission) => $permission->toArray(), $this->permissions ?? []),
        ];
    }
}

