<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Entities\Role;
use App\Domain\Factories\RoleFactory;
use App\Domain\Repositories\IRoleRepository;
use App\Infrastructure\Persistence\Models\Role as RoleModel;
use Exception;
use Illuminate\Support\Facades\Log;

class RoleRepository implements IRoleRepository
{
    public function findByName(string $roleName): Role
    {
        try {
            $role = RoleModel::with('permissions')->where('name', $roleName)->first();

            return RoleFactory::fromModel($role);
        } catch (Exception $e) {
            Log::error('Error al obtener el rol: ' . $e->getMessage());
            throw new \RuntimeException('Error en la base de datos al intentar obtener el rol.');
        }
    }
}
