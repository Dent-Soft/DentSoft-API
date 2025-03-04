<?php

namespace App\Domain\Factories;

use App\Application\DTOs\User\CreateUserDTO;
use App\Domain\Entities\Permission;
use App\Domain\Entities\Role;
use App\Domain\Entities\User;
use App\Infrastructure\Persistence\Models\Role as RoleModel;

class RoleFactory
{
    // /**
    //  * Creates a new instance of the User entity from a DTO.
    //  *
    //  * @param CreateUserDTO $userDTO Data transfer object with user information.
    //  * @return User
    //  */
    // public static function create(CreateRoleDTO $roleDTO): Role
    // {
    //     return new Role(

    //     );
    // }

    public static function fromModel(RoleModel $roleModel): Role
    {
        $permissionsEntities = [];

        foreach ($roleModel->permissions as $permission) {
            $permissionsEntities[] = new Permission($permission->id, $permission->name, $permission->display_name, $permission->description);
        }

        return new Role(
            $roleModel->id,
            $roleModel->name,
            $roleModel->display_name,
            $roleModel->description,
            $permissionsEntities
        );
    }
}
