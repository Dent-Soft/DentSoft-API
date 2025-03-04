<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Role;

interface IRoleRepository
{
    public function findByName(string $roleName): Role;
}
