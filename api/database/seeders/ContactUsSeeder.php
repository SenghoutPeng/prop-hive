<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contact_us')->insert([
            [
                'contact_us_name' => 'Emma Wilson',
                'contact_us_email' => 'emma@example.com',
                'contact_us_message' => 'I would like to schedule a property viewing.',
                'contact_us_submitted_at' => now()->subDays(5)->toDateString(),
                'contact_us_status' => 'contacted',
            ],
            [
                'contact_us_name' => 'James Martinez',
                'contact_us_email' => 'james@example.com',
                'contact_us_message' => 'Do you offer property management services?',
                'contact_us_submitted_at' => now()->subDays(2)->toDateString(),
                'contact_us_status' => 'pending',
            ],
        ]);
    }
}