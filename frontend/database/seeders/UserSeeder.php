<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Laravel users table
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Robert Johnson',
                'email' => 'robert@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Custom user table
        DB::table('user')->insert([
            [
                'user_name' => 'Alice Williams',
                'user_password' => Hash::make('password'),
                'user_email' => 'alice@example.com',
                'user_phone' => '+1234567892',
                'user_profile_picture' => 'profiles/alice.jpg',
                'is_admin' => false,
            ],
            [
                'user_name' => 'Bob Brown',
                'user_password' => Hash::make('password'),
                'user_email' => 'bob@example.com',
                'user_phone' => '+1234567893',
                'user_profile_picture' => 'profiles/bob.jpg',
                'is_admin' => false,
            ],
            [
                'user_name' => 'Admin User',
                'user_password' => Hash::make('admin123'),
                'user_email' => 'adminuser@example.com',
                'user_phone' => '+1234567894',
                'user_profile_picture' => 'profiles/admin.jpg',
                'is_admin' => true,
            ],
        ]);
    }
}