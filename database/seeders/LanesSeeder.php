<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lanes')->insert([
            ['lane_number' => 1, 'is_available' => true],
            ['lane_number' => 2, 'is_available' => true],
            ['lane_number' => 3, 'is_available' => false],
        ]);
    }
}
