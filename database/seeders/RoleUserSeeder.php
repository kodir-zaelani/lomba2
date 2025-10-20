<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //assign permission to role
        $role        = Role::find('9f4846f7-68fc-4440-8f8f-ec5f3ebb15ac');
        $permissions_web = Permission::all();

        $role->syncPermissions($permissions_web);

        //assign role with permission to user
        $user = User::find('9f48408c-53fc-4038-ac05-7cc27ae2cdd2');
        $user->assignRole($role->name);
    }
}
