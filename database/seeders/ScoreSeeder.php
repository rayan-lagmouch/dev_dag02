<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('scores')->insert([
            [
                'total_score' => 150,
                'game_date' => now()->toDateString(),
            ],
            [
                'total_score' => 200,
                'game_date' => now()->subDay()->toDateString(),
            ],
        ]);
    }
}
