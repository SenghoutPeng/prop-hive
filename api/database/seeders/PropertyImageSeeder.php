<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyImageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('property_image')->insert([
            [
                'property_id' => 1,
                'image_url' => 'images/property1/main.jpg',
                'uploaded_at' => now(),
            ],
            [
                'property_id' => 1,
                'image_url' => 'images/property1/kitchen.jpg',
                'uploaded_at' => now(),
            ],
            [
                'property_id' => 1,
                'image_url' => 'images/property1/bedroom.jpg',
                'uploaded_at' => now(),
            ],
            [
                'property_id' => 2,
                'image_url' => 'images/property2/exterior.jpg',
                'uploaded_at' => now(),
            ],
            [
                'property_id' => 2,
                'image_url' => 'images/property2/living_room.jpg',
                'uploaded_at' => now(),
            ],
            [
                'property_id' => 3,
                'image_url' => 'images/property3/office.jpg',
                'uploaded_at' => now(),
            ],
        ]);
    }
}