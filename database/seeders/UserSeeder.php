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
// Create roles if they don't exist
$roles = ['guest', 'customer', 'employee', 'administrator'];

// Create roles
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
'role' => 'customer',
],
];

foreach ($users as $userData) {
$user = User::create([
'name' => $userData['name'],
'email' => $userData['email'],
'password' => Hash::make('password'), // default password
]);

$user->assignRole($userData['role']); // Assign the role to the user
}
}
}
