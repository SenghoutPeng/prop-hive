<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'name' => 'Michael Chen',
                'email' => 'michael@example.com',
                'subject' => 'Property Inquiry',
                'message' => 'I am interested in the downtown apartment listing.',
                'status' => 'replied',
                'assigned_to' => 1,
                'read_at' => now()->subDays(2),
                'replied_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'subject' => 'Maintenance Request',
                'message' => 'The heating system needs servicing.',
                'status' => 'in_progress',
                'assigned_to' => 2,
                'read_at' => now()->subHours(12),
                'replied_at' => null,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(12),
            ],
            [
                'name' => 'David Lee',
                'email' => 'david@example.com',
                'subject' => 'General Inquiry',
                'message' => 'What are your office hours?',
                'status' => 'pending',
                'assigned_to' => null,
                'read_at' => null,
                'replied_at' => null,
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],
        ]);
    }
}