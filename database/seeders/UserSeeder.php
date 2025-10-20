<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'id'                => '9f48408c-53fc-4038-ac05-7cc27ae2cdd2',
            'name'              => 'Administrator',
            'slug'              => 'administrator',
            'email'             => 'admin@tktunasberiman.sch.id',
            'username'          => '@dmin!',
            'celuller_no'      => '082159888845',
            'masterstatus'      => '1',
            'email_verified_at' => now(),
            'password'          => bcrypt('Secret12!'),
            'remember_token'    => Str::random(30),
        ]);
    }
}