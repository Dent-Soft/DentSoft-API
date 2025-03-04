<?php

namespace App\Domain\Entities;

use App\Domain\Attributes\Getter;
use App\Domain\Attributes\Setter;
use App\Domain\Traits\AccessorTrait;

class Permission
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
    ) {
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'display_name' => $this->displayName,
            'description'  => $this->description,
        ];
    }
}

