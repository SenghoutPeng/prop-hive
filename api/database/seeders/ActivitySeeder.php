<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('activities')->insert([
            [
                'user_id' => 1,
                'type' => 'login',
                'description' => 'User logged in',
                'subject_id' => null,
                'subject_type' => null,
                'ip_address' => '192.168.1.1',
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'user_id' => 1,
                'type' => 'property_view',
                'description' => 'Viewed property listing',
                'subject_id' => 1,
                'subject_type' => 'Property',
                'ip_address' => '192.168.1.1',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
            [
                'user_id' => 2,
                'type' => 'payment',
                'description' => 'Made rent payment',
                'subject_id' => 1,
                'subject_type' => 'Payment',
                'ip_address' => '192.168.1.5',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
            [
                'user_id' => 1,
                'type' => 'support_ticket',
                'description' => 'Created support ticket',
                'subject_id' => 1,
                'subject_type' => 'SupportTicket',
                'ip_address' => '192.168.1.1',
                'created_at' => now()->subMinutes(15),
                'updated_at' => now()->subMinutes(15),
            ],
            [
                'user_id' => 3,
                'type' => 'property_inquiry',
                'description' => 'Sent property inquiry',
                'subject_id' => 2,
                'subject_type' => 'Property',
                'ip_address' => '192.168.1.10',
                'created_at' => now()->subMinutes(5),
                'updated_at' => now()->subMinutes(5),
            ],
        ]);
    }
}