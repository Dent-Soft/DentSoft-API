<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Models\Role;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Infrastructure\Persistence\Models\User as UserModel;

class OwnerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            try {
                $existingUser = UserModel::where('email', 'esteveznicolas0@gmail.com')->first();

                if ($existingUser) {
                    Log::warning('The user owner already exists.');
                    throw new Exception('The user owner already exists.');
                }

                $userModel = new UserModel();
                $userModel->name = 'Owner User';
                $userModel->email = 'owner@example.com';
                $userModel->phone_1 = '1234567890';
                $userModel->phone_2 = '0987654321';
                $userModel->address = '123 Main St, City';
                $userModel->emergency_contacts = '["Emergency Contact 1"]';
                $userModel->password = Hash::make('password123');
                $userModel->birth_date = '1990-01-01';
                $userModel->save();

                $ownerRole = Role::where('name', 'owner')->first();

                if (!$ownerRole) {
                    Log::error(message: 'Role "owner" does not exists.');
                    throw new Exception('Role "owner" does not exists.');
                }

                $userModel->addRole($ownerRole);

                Log::info('User owner created succesfully.');
            } catch (Exception $e) {
                Log::error('Error when creating the user Owner: ' . $e->getMessage());
                throw $e;
            }
        });
    }
}
