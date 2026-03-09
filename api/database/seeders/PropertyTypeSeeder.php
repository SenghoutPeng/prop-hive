<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('property_type')->insert([
            ['property_type_name' => 'Residential'],
            ['property_type_name' => 'Commercial'],
            ['property_type_name' => 'Industrial'],
            ['property_type_name' => 'Land'],
            ['property_type_name' => 'Mixed-Use'],
        ]);
    }
}