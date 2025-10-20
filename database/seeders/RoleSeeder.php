<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'id'         => '9f4846f7-68fc-4440-8f8f-ec5f3ebb15ac',
            'name'       => 'superadmin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'id'         => '9f4846f7-6b5b-4744-8bb9-42b4e7c13251',
            'name'       => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'id'         => '9f4846f7-6c65-49f2-9ca0-29f86a4aebff',
            'name'       => 'author',
            'guard_name' => 'web'
        ]);
        Role::create([
            'id'         => '9f4846f7-6d58-4b88-86bc-501d75f0af9f',
            'name'       => 'subscribe',
            'guard_name' => 'web'
        ]);
        Role::create([
            'id'         => '9f4846f7-6e3f-465e-9394-124c1c6ec83f',
            'name'       => 'general',
            'guard_name' => 'web'
        ]);
    }
}
