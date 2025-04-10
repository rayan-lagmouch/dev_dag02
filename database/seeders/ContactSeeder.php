<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'person_id' => 1,
                'emergency_contact_name' => 'Emily Doe',
                'emergency_contact_phone' => '555-1234',
                'address' => '123 Main Street',
            ],
            [
                'person_id' => 2,
                'emergency_contact_name' => 'Michael Smith',
                'emergency_contact_phone' => '555-5678',
                'address' => '456 Elm Street',
            ],
        ]);
    }
}
