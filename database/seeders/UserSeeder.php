<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Hash the password
            'email_verified_at' => now(),
            'is_admin' => true,  // Assuming you have an is_admin field
        ]);

        // Create the regular user
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'), // Hash the password
            'email_verified_at' => now(),
            'is_admin' => false,  // Regular user
        ]);
    }
}
