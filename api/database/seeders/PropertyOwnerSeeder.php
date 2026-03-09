<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyOwnerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('property_owner')->insert([
            [
                'user_id' => 1,
                'property_id' => 1,
            ],
            [
                'user_id' => 1,
                'property_id' => 3,
            ],
            [
                'user_id' => 2,
                'property_id' => 2,
            ],
            [
                'user_id' => 2,
                'property_id' => 4,
            ],
        ]);
    }
}