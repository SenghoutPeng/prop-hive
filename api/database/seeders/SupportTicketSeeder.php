<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportTicketSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('support_ticket')->insert([
            [
                'user_id' => 1,
                'user_email' => 'alice@example.com',
                'support_ticket_message' => 'Unable to access payment portal.',
                'support_ticket_status' => 'resolved',
                'support_ticket_created_at' => now()->subDays(3),
                'support_ticket_responded_at' => now()->subDays(2),
                'name' => 'Alice Williams',
            ],
            [
                'user_id' => 2,
                'user_email' => 'bob@example.com',
                'support_ticket_message' => 'Question about lease renewal process.',
                'support_ticket_status' => 'open',
                'support_ticket_created_at' => now()->subDays(1),
                'support_ticket_responded_at' => null,
                'name' => 'Bob Brown',
            ],
            [
                'user_id' => null,
                'user_email' => 'guest@example.com',
                'support_ticket_message' => 'Interested in property viewing.',
                'support_ticket_status' => 'pending',
                'support_ticket_created_at' => now()->subHours(6),
                'support_ticket_responded_at' => null,
                'name' => 'Guest User',
            ],
        ]);
    }
}