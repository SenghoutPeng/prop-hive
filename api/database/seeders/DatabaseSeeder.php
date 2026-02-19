<?php

namespace Database\Seeders;

use App\Models\FrontendModel\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user
        User::create([
            'user_name' => 'Test User',
            'user_email' => 'test@example.com',
            'user_password' => Hash::make('password123'),
            'is_admin' => false,
        ]);

        // Create an admin user
        User::create([
            'user_name' => 'Admin User',
            'user_email' => 'admin@example.com',
            'user_password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        // Create another admin user with your email
        User::create([
            'user_name' => 'Admin',
            'user_email' => 'admin@gmail.com',
            'user_password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);
    }
}
