<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilityRequestSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('utility_request')->insert([
            [
                'user_id' => 1,
                'property_id' => 1,
                'utility_request_description' => 'Water heater not working properly. Needs immediate attention.',
                'utility_request_status' => 'resolved',
                'utility_request_created_at' => now()->subDays(5),
                'utility_request_responded_at' => now()->subDays(4),
            ],
            [
                'user_id' => 2,
                'property_id' => 2,
                'utility_request_description' => 'AC unit making strange noises.',
                'utility_request_status' => 'in_progress',
                'utility_request_created_at' => now()->subDays(2),
                'utility_request_responded_at' => now()->subDays(1),
            ],
            [
                'user_id' => 1,
                'property_id' => 1,
                'utility_request_description' => 'Kitchen sink is leaking.',
                'utility_request_status' => 'pending',
                'utility_request_created_at' => now()->subHours(12),
                'utility_request_responded_at' => null,
            ],
        ]);
    }
}