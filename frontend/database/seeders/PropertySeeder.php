<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Properties table (modern)
        DB::table('properties')->insert([
            [
                'title' => 'Luxury Downtown Apartment',
                'description' => 'Beautiful 2-bedroom apartment in the heart of downtown with stunning city views.',
                'price' => 450000.00,
                'type' => 'apartment',
                'status' => 'available',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'square_feet' => 1200,
                'address' => '123 Main St, Downtown, City',
                'features' => 'parking,gym,pool,security',
                'images' => 'property1_1.jpg,property1_2.jpg',
                'owner_id' => 1,
                'agent_id' => 1,
                'is_featured' => true,
                'is_active' => true,
                'tenant_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Suburban Family House',
                'description' => 'Spacious 4-bedroom house perfect for families in a quiet neighborhood.',
                'price' => 650000.00,
                'type' => 'house',
                'status' => 'available',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'square_feet' => 2500,
                'address' => '456 Oak Avenue, Suburb',
                'features' => 'garden,garage,fireplace',
                'images' => 'property2_1.jpg,property2_2.jpg',
                'owner_id' => 2,
                'agent_id' => 2,
                'is_featured' => true,
                'is_active' => true,
                'tenant_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modern Studio Apartment',
                'description' => 'Cozy studio apartment ideal for young professionals.',
                'price' => 250000.00,
                'type' => 'apartment',
                'status' => 'rented',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'square_feet' => 600,
                'address' => '789 Park Lane, City Center',
                'features' => 'parking,security',
                'images' => 'property3_1.jpg',
                'owner_id' => 1,
                'agent_id' => 1,
                'is_featured' => false,
                'is_active' => true,
                'tenant_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Commercial Office Space',
                'description' => 'Prime office space in business district.',
                'price' => 850000.00,
                'type' => 'commercial',
                'status' => 'available',
                'bedrooms' => null,
                'bathrooms' => 4,
                'square_feet' => 3000,
                'address' => '101 Business Blvd, Downtown',
                'features' => 'parking,elevator,conference_rooms',
                'images' => 'property4_1.jpg,property4_2.jpg',
                'owner_id' => 2,
                'agent_id' => 2,
                'is_featured' => true,
                'is_active' => true,
                'tenant_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Property table (legacy)
        DB::table('property')->insert([
            [
                'property_size' => 1200,
                'price' => 450000.00,
                'property_title' => 'Downtown Condo',
                'location' => 'Downtown',
                'description' => 'Modern condo with city views',
                'property_status' => 'available',
                'property_type_id' => 1,
                'admin_id' => 1,
            ],
            [
                'property_size' => 2500,
                'price' => 650000.00,
                'property_title' => 'Family Villa',
                'location' => 'Suburbs',
                'description' => 'Spacious villa with garden',
                'property_status' => 'available',
                'property_type_id' => 1,
                'admin_id' => 1,
            ],
            [
                'property_size' => 3000,
                'price' => 850000.00,
                'property_title' => 'Office Building',
                'location' => 'Business District',
                'description' => 'Commercial office space',
                'property_status' => 'sold',
                'property_type_id' => 2,
                'admin_id' => 2,
            ],
        ]);
    }
}