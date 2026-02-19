<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('team_members')->insert([
            [
                'name' => 'Jennifer Adams',
                'position' => 'CEO & Founder',
                'bio' => 'With over 20 years of experience in real estate, Jennifer leads our company with vision and integrity.',
                'image' => 'team/jennifer.jpg',
                'email' => 'jennifer@company.com',
                'phone' => '+1234567800',
                'linkedin' => 'https://linkedin.com/in/jenniferadams',
                'twitter' => 'https://twitter.com/jadams',
                'facebook' => null,
                'status' => 'active',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Roberts',
                'position' => 'Senior Property Agent',
                'bio' => 'Michael specializes in luxury properties and has helped hundreds of clients find their dream homes.',
                'image' => 'team/michael.jpg',
                'email' => 'michael@company.com',
                'phone' => '+1234567801',
                'linkedin' => 'https://linkedin.com/in/michaelroberts',
                'twitter' => null,
                'facebook' => 'https://facebook.com/mroberts',
                'status' => 'active',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lisa Thompson',
                'position' => 'Property Manager',
                'bio' => 'Lisa oversees our property management division, ensuring excellent service for all our clients.',
                'image' => 'team/lisa.jpg',
                'email' => 'lisa@company.com',
                'phone' => '+1234567802',
                'linkedin' => 'https://linkedin.com/in/lisathompson',
                'twitter' => 'https://twitter.com/lthompson',
                'facebook' => null,
                'status' => 'active',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Kim',
                'position' => 'Commercial Real Estate Agent',
                'bio' => 'David focuses on commercial properties and business real estate solutions.',
                'image' => 'team/david.jpg',
                'email' => 'david@company.com',
                'phone' => '+1234567803',
                'linkedin' => 'https://linkedin.com/in/davidkim',
                'twitter' => null,
                'facebook' => null,
                'status' => 'active',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}