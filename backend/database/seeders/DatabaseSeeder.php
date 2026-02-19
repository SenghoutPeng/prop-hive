<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            PropertyTypeSeeder::class,
            PropertySeeder::class,
            PropertyOwnerSeeder::class,
            PropertyImageSeeder::class,
            PaymentSeeder::class,
            UtilityBillSeeder::class,
            UtilityRequestSeeder::class,
            SupportTicketSeeder::class,
            ContactSeeder::class,
            ContactUsSeeder::class,
            FaqSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            ActivitySeeder::class,
        ]);
    }
}