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
                'person_id' => 1,
                'order_time' => now(),
                'total_amount' => 50.75,
                'payment_method' => 'online',
                'status' => 'paid',
                'packages' => json_encode(['basic_snack_package', 'luxury_snack_package']), // Correctly encode the packages
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'person_id' => 2,
                'order_time' => now(),
                'total_amount' => 35.00,
                'payment_method' => 'cash',
                'status' => 'cancelled',
                'packages' => json_encode(['children_party']), // Correctly encode the packages
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
