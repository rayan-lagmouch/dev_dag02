<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // First create users
        $this->call(UserSeeder::class);

        // Then create roles and assign them
        $this->call(RoleSeeder::class);
    }
}
