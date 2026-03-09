<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'admin_name' => 'Super Admin',
                'admin_password' => Hash::make('admin123'),
                'admin_email' => 'admin@example.com',
                'admin_phone' => '+1234567890',
            ],
            [
                'admin_name' => 'Property Manager',
                'admin_password' => Hash::make('manager123'),
                'admin_email' => 'manager@example.com',
                'admin_phone' => '+1234567891',
            ],
        ]);
    }
}