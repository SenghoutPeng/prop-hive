<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment')->insert([
            [
                'user_id' => 1,
                'property_id' => 1,
                'payment_amount' => 2500,
                'payment_date' => '2024-01-15',
                'payment_status' => 'completed',
                'payment_type' => 'rent',
            ],
            [
                'user_id' => 2,
                'property_id' => 2,
                'payment_amount' => 3000,
                'payment_date' => '2024-01-20',
                'payment_status' => 'completed',
                'payment_type' => 'rent',
            ],
            [
                'user_id' => 1,
                'property_id' => 1,
                'payment_amount' => 2500,
                'payment_date' => '2024-02-15',
                'payment_status' => 'pending',
                'payment_type' => 'rent',
            ],
            [
                'user_id' => 3,
                'property_id' => 3,
                'payment_amount' => 450000,
                'payment_date' => '2024-01-10',
                'payment_status' => 'completed',
                'payment_type' => 'purchase',
            ],
        ]);
    }
}