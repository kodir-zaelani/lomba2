<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call(SettingSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(RoleSeeder::class);
        // $this->call(RoleUserSeeder::class);
        // $this->call(RoleUseradminSeeder::class);
        // $this->call(NegaraSeeder::class);
        $this->call(JenisPtkSeeder::class);
        // $this->call(AgamaSeeder::class);
    }
}