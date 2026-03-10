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
        // DB::table('users')->insert([
        //     [
        //         'name' => 'Yongye Uy',
        //         'email' => 'yuy@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Henglong Loeung',
        //         'email' => 'hloeung@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'Nancy',
        //         'email' => 'nancy@example.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);

        // Custom user table
        DB::table('user')->insert([
            [
                'user_name' => 'Yongye Uy',
                'user_password' => Hash::make('password'),
                'user_email' => 'yuy@example.com',
                'user_phone' => '+1234567892',
                'user_profile_picture' => 'profiles/yongye.jpg',
                'is_admin' => false,
            ],
            [
                'user_name' => 'Sok Phea',
                'user_password' => Hash::make('password'),
                'user_email' => 'sphea@example.com',
                'user_phone' => '+1234567893',
                'user_profile_picture' => 'profiles/sokphea.jpg',
                'is_admin' => false,
            ],
            [
                'user_name' => 'Kunaratadmin_idh',
                'user_password' => Hash::make('password'),
                'user_email' => 'admin@example.com',
                'user_phone' => '+1234567894',
                'user_profile_picture' => 'profiles/admin.jpg',
                'is_admin' => true,
            ],
        ]);
    }
}
