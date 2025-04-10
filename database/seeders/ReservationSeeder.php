<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            [
                'person_id' => 1,
                'lane_id' => 1,
                'reservation_date' => now()->toDateString(),
                'start_time' => '14:00:00',
                'end_time' => '16:00:00',
                'number_of_players' => 4,
            ],
            [
                'person_id' => 2,
                'lane_id' => 2,
                'reservation_date' => now()->addDay()->toDateString(),
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
                'number_of_players' => 2,
            ],
        ]);
    }
}
