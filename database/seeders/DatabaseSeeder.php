<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            PeopleSeeder::class,
            LanesSeeder::class,
            ReservationSeeder::class,
            ContactSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
