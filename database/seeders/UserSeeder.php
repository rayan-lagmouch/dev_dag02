<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Optionally truncate the users table to clear old records
        User::truncate();  // Clears all users from the table

        // Create roles if they don't exist
        $roles = ['guest', 'member', 'employee', 'administrator'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Seed users with roles
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@bowling.com',
                'role' => 'administrator',
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@bowling.com',
                'role' => 'employee',
            ],
            [
                'name' => 'Member User',
                'email' => 'member@bowling.com',
                'role' => 'member',
            ],
            [
                'name' => 'Guest User',
                'email' => 'guest@bowling.com',
                'role' => 'guest',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'), // default password
            ]);

            $user->assignRole($userData['role']);
        }
    }
}
