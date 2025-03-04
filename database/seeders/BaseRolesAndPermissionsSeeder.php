<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Models\Permission;
use App\Infrastructure\Persistence\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BaseRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            try {
                $owner = Role::create([
                    'name'         => 'owner',
                    'display_name' => 'Project Owner',
                    'description'  => 'User is the owner of a given project'
                ]);

                $guest = Role::create([
                    'name'         => 'guest',
                    'display_name' => 'Guest User',
                    'description'  => 'This user is allowed to perform basic actions'
                ]);

                $createUser = Permission::create([
                    'name'         => 'create-user',
                    'display_name' => 'Create Users',
                    'description'  => 'Create new users'
                ]);

                $deleteUser = Permission::create([
                    'name'         => 'delete-user',
                    'display_name' => 'Delete Users',
                    'description'  => 'Delete existing users'
                ]);

                $editUser = Permission::create([
                    'name'         => 'edit-user',
                    'display_name' => 'Edit Users',
                    'description'  => 'Edit existing users'
                ]);

                $editProfile = Permission::create([
                    'name'         => 'edit-profile',
                    'display_name' => 'Edit Profile',
                    'description'  => 'Edit own profile'
                ]);

                $startTrial = Permission::create([
                    'name'         => 'start-trial',
                    'display_name' => 'Start Trial',
                    'description'  => 'Start trial for guest user'
                ]);

                $owner->givePermissions([ $createUser, $deleteUser, $editUser ]);
                $guest->givePermissions([ $startTrial, $editProfile ]);

                Log::info('Roles and permissions created succesfully.');
            } catch (\Exception $e) {
                Log::error('Error when creating base permissions and roles: ' . $e->getMessage());
                throw $e;
            }
        });
    }

}
