<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeopleSeeder extends Seeder
{
    public function run(): void
    {
        // First, disable foreign key checks temporarily to avoid issues during truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate the tables to avoid duplicates
        DB::table('users')->truncate();
        DB::table('people')->truncate();

        // Seed the users table first with different roles (name is dynamic)
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin User',
            'email' => 'admin@bowling.com',
            'password' => Hash::make('password'),
        ]);

        $employeeId = DB::table('users')->insertGetId([
            'name' => 'Employee User',
            'email' => 'employee@bowling.com',
            'password' => Hash::make('password'),
        ]);

        $guestId = DB::table('users')->insertGetId([
            'name' => 'Guest User',
            'email' => 'guest@bowling.com',
            'password' => Hash::make('password'),
        ]);

        // Seed the people table using the user_id and role, now including first_name, last_name, and email
        DB::table('people')->insert([
            [
                'user_id' => $adminId,  // Link to 'users' table
                'first_name' => 'Admin',  // First name
                'last_name' => 'User',  // Last name
                'email' => 'admin@bowling.com', // Email
                'role' => 'Admin',  // Role is dynamically assigned
            ],
            [
                'user_id' => $employeeId,  // Link to 'users' table
                'first_name' => 'Employee',  // First name
                'last_name' => 'User',  // Last name
                'email' => 'employee@bowling.com', // Email
                'role' => 'Employee',  // Role is dynamically assigned
            ],
            [
                'user_id' => $guestId,  // Link to 'users' table
                'first_name' => 'Guest',  // First name
                'last_name' => 'User',  // Last name
                'email' => 'guest@bowling.com', // Email
                'role' => 'customer',  // Role is dynamically assigned
            ],
        ]);

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
