<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUseradminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //assign permission to role
        $role        = Role::find('9f4846f7-6b5b-4744-8bb9-42b4e7c13251');
        $permissions_web = Permission::all();

        $role->syncPermissions($permissions_web);

    }
}
