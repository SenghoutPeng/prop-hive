<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtilityBillSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('utility_bill')->insert([
            [
                'user_id' => 1,
                'property_id' => 1,
                'utility_bill_type' => 'electricity',
                'utility_bill_usage' => 450,
                'utility_bill_amount' => 125,
                'utility_bill_date' => '2024-01-01',
                'utility_bill_due_date' => '2024-01-15',
                'utility_bill_status' => 'paid',
            ],
            [
                'user_id' => 1,
                'property_id' => 1,
                'utility_bill_type' => 'water',
                'utility_bill_usage' => 5000,
                'utility_bill_amount' => 45,
                'utility_bill_date' => '2024-01-01',
                'utility_bill_due_date' => '2024-01-15',
                'utility_bill_status' => 'paid',
            ],
            [
                'user_id' => 2,
                'property_id' => 2,
                'utility_bill_type' => 'electricity',
                'utility_bill_usage' => 620,
                'utility_bill_amount' => 175,
                'utility_bill_date' => '2024-01-01',
                'utility_bill_due_date' => '2024-01-15',
                'utility_bill_status' => 'pending',
            ],
            [
                'user_id' => 2,
                'property_id' => 2,
                'utility_bill_type' => 'gas',
                'utility_bill_usage' => 300,
                'utility_bill_amount' => 85,
                'utility_bill_date' => '2024-01-01',
                'utility_bill_due_date' => '2024-01-15',
                'utility_bill_status' => 'pending',
            ],
        ]);
    }
}