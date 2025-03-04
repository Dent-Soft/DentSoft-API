<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface IUserRepository
{
    public function create(User $entity): User;
}
