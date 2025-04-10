<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'reservation_id' => 1,
                'order_time' => now(),
                'total_amount' => 50.75,
                'payment_method' => 'Credit Card',
                'is_paid' => true,
            ],
            [
                'reservation_id' => 2,
                'order_time' => now(),
                'total_amount' => 35.00,
                'payment_method' => 'Cash',
                'is_paid' => false,
            ],
        ]);
    }
}
